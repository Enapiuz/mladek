<?php
namespace my_project::my_app;
use mladek::core::http;


class views
{
    static function my_method()
    {
        return http::response('Hello World!');
    }
}
