<?php

    return [
        self::get('/product/get', 'ProductController@get')
        ,self::post('/product/post', 'ProductController@post')
    ];