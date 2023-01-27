<?php
// $app = require __DIR__ . '/bootstrap.php';
// $app->run();

require __DIR__ . '/bootstrap.php';

if(in_array(php_sapi_name(), ['fpm-fcgi'])){
    $app->main($_REQUEST);
}
else{
    
}
