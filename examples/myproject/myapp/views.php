<?php
namespace myproject::myapp::views;

use mladek::http::HttpResponse;
use mladek::conf::urls::urls;
use mladek::templates::Template;
use mladek::templates::Context;


function mymethod($request)
{
    return new HttpResponse('Hello World!');
}


function article($request, $id)
{
    $context['link'] = urls::reverse('article', $id);
    $context['Name'] = 'Vasek';
    $c = new Context($context);
    $t = mladek::templates::get_template('article.html');
    $text = $t->render($c);
    return new HttpResponse($text);
}
