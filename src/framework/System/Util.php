<?php

    if(!function_exists('dd')){
        function dd(...$var){
            foreach($var as $v){
                echo "<pre style=\"background-color: black; color: green; padding: 10px;\">";
                    var_dump($var);
                echo "</pre>";
            }
            die();
        }
    }
    