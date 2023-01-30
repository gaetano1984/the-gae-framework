<?php

    namespace App\Controllers;

    use App\Services\ProductService;

    class ProductController{
        private $name;
        private $productService;
        public function __construct(ProductService $productService, $num){
            $this->productService = $productService;
        }    
        public function get($id){
            $res = $this->productService->get($id);
            echo $res;
        }
        public function post($id){
            return 1;
        }
    }

