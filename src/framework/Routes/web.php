<?php

    return [
        self::get('/product/get', 'ProductController@get')
        ,self::get('/product/post', 'ProductController@post')
    ];