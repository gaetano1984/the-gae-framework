<?php

namespace App;

use App\Container\Container;

class Application extends Container{
    public function main($request){
        $class = ucfirst($request['class']);
        $method = $request['method'];
        $c = $this->register("Controllers".$class."Controller::class", "App\Controllers\\".$class."Controller");
        $instance = $this->get("Controllers".$class."Controller::class");
        $this->executeMethod($instance, $method);
    }
}