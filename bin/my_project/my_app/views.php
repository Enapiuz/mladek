<?php
namespace my_project::my_app;
use mladek::core::http;
use mladek::core::urls;


class views
{
    static function my_method()
    {
        return http::response('Hello World!');
    }
    
    static function article($id)
    {
        $text = 'You see article on url '.urls::reverse('article', $id);
        return http::response($text);
    }
}
