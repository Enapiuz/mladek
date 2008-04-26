<?php
namespace my_project::my_app::views;
use mladek::http::HttpResponse;
use mladek::conf::urls::urls;


function my_method()
{
    return new HttpResponse('Hello World!');
}

function article($id)
{
    $text = 'You see article on url '.urls::reverse('article', $id);
    return new HttpResponse($text);
}
