<?php

    namespace System;

    class Routes{
        public $web_routes = [];
        public static $routes = [];
        public function __construct(){
            $web_routes = include('routes/web.php');
            self::$routes = array_map(function($w){
                return [
                    'url' => $w['url']
                    ,'callback' => $w['callback']
                    ,'method' => $w['method']
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

        public static function getRoutes(){
            return self::$routes;
        }

        public static function checkRoutes($tmp_route, $method){
            $check = false;
            foreach(self::getRoutes() as $route){
                if($route['url']==$tmp_route && $route['method']==$method){
                    $check = TRUE;
                    break;
                }
            }
            return $check;
        }

        public static function getCallBack($route, $method){
            $callback =  null;
            foreach(self::getRoutes() as $tmp_route){
                if($tmp_route['url']==strtolower($route) && $tmp_route['method']==$method){
                    $callback = $tmp_route['callback'];
                }
            }
            $callback = explode('@', $callback);
            $callback = [
                'class' => $callback[0]
                ,'method' => $callback[1]
            ];
            return $callback;
        }
    }