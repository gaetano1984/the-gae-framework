<?php

namespace App;

use System\Container\Container;
use System\Routes;

class Application extends Container{
    public $routes = [];
    
    public function __construct(){
    }
    
    public function main($request){
        $class = ucfirst($request['class']);
        $method = $request['method'];
        $callback = $this->getCallBack("/".$class."/".$method);
        $c = $this->register("Controllers\\".$callback['class']."::class", "App\Controllers\\".$callback['class']);
        $instance = $this->get("Controllers\\".$callback['class']."::class");
        $this->executeMethod($instance, $callback['method']);
    }
    
    public function buildRoutes($request){
        $r = new Routes();
    }
    
    public function checkRoutes($request){
        if(!array_key_exists('class', $request) || !array_key_exists('method', $request)){
            dd('400, parametro mancante');
            die();
        }
        $r = new Routes();
        $check = FALSE;
        $tmp_route = "/".$request['class']."/".$request['method'];
        $check = $r->checkRoutes($tmp_route, $_SERVER['REQUEST_METHOD']);
        return $check;
    }

    public function getCallBack($route){
        $r = new Routes();
        $callback = $r->getCallBack($route, $_SERVER['REQUEST_METHOD']);
        return $callback;
    }

}