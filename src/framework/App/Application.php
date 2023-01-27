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
        $c = $this->register("Controllers".$class."Controller::class", "App\Controllers\\".$class."Controller");
        $instance = $this->get("Controllers".$class."Controller::class");
        $this->executeMethod($instance, $method);
    }
}