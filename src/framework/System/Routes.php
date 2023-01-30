<?php

    namespace System;

    class Routes{
        public $web_routes = [];
        public static $routes = [];
        public function __construct(){
            $web_routes = include('routes/web.php');
            $routes = array_map(function($w){
                return [
                    'url' => $w['url']
                    ,'callback' => $w['callback']
                    ,'mehod' => $w['method']
                ];
            }, $web_routes);
        }
        
        public static function get($url, $callback){
            return self::addRoute($url, $callback, 'GET');
        }

        public function post($route){
            return self::addRoute($url, $callback, 'POST');
        }

        public static function addRoute($url, $callback, $method){  
            return [
                'url' => $url
                ,'callback' => $callback
                ,'method' => $method
            ];
        }
    }