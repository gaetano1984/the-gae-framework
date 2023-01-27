<?php

    namespace System\Container;

    // use App\Exceptions\NotFoundException;
    use Psr\Container\ContainerInterface;

    class Container implements ContainerInterface{
        private $services = [];

        /**
         * costruisce un mapping interno tra nomi delle classi e classi presenti nel namespce
         */
        public function register(string $key, $value){
            $this->services[$key] = $this->resolveDependencies($value); 
            return $this;
        }

        /**
         * controlla se una classe è presente tra quelle disponibili, se sì restituisce la reflection
         */
        public function get(string $id){
            try{
                if(isset($this->services[$id])){
                    return $this->services[$id];
                }
                else{
                    $this->services[$id] = $this->resolveDependencies($id);
                    return $this->services[$id];
                }
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }

        /**
         * controlla se una classe è disponibile
         */
        public function has(string $id):bool{
            return isset($this->services[$id]);
        }

        /**
         * controlla se una classe o una classback è presente e ne restituisce l'esecuzione
         */
        public function resolveDependencies($item){ 
            if(is_callable($item)){
                return $item();
            }

            $reflection = new \ReflectionClass($item);
            return $this->getInstance($reflection);
        }

        /**
         * recupera il costruttore della classe, recupera i parametri, istanzia la classe
         */
        public function getInstance(\ReflectionClass $item){
            $constructor = $item->getConstructor();
            $dependencies = [];
            if (is_null($constructor) || $constructor->getNumberOfRequiredParameters() == 0) {
                return $item->newInstance();
            }
            foreach($constructor->getParameters() as $p){
                if($p->getType()){
                    if(get_class($p->getType())=='ReflectionNamedType'){
                        $paramInstance = $p->getClass()->newInstance();
                        $dependencies[] = $paramInstance;
                    }
                    if($type = $p->getType()){
                        $dependencies[] = $this->get($type->getName());
                    }
                } 
            }
            $instance = $item->newInstance(...$dependencies);
            return $instance;
        }

        /** 
         * esegue il metodo della classe richiesta
         */
        public function executeMethod($instance, $method){
            $reflectionMethod = new \ReflectionMethod($instance, $method);
            return $reflectionMethod->invokeArgs($instance,[1]); //$params);
        }
    }