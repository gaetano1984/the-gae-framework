<?php
// $app = require __DIR__ . '/bootstrap.php';
// $app->run();

require __DIR__ . '/bootstrap.php';

if(in_array(php_sapi_name(), ['fpm-fcgi'])){
    $app->buildRoutes($_REQUEST);
    $check = $app->checkRoutes($_REQUEST);
    if($check==FALSE){
        dd("404 not found");
        die();
    }

    $app->main($_REQUEST);
}
else{
    
}
