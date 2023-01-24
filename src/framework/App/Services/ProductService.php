<?php

    namespace App\Services;

    class ProductService{
        public function __construct(){
            return $this;
        }
        public function get($id){
            return __CLASS__." $id OK";
        }
    }