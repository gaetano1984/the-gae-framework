<?php

    if(!function_exists('dd')){
        function dd(...$var){
            foreach($var as $v){
                echo "<pre style=\"background-color: black; color: green; padding: 10px;\">";

                    if(is_string($v)){
                        echo $v;
                    }
                    else{
                        var_dump($v);
                    }
                    
                echo "</pre>";
            }
            die();
        }
    }