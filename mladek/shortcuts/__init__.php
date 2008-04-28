<?php
namespace mladek::shortcuts;

use mladek::templates::Template;
use mladek::templates::Context;
use mladek::http::HttpResponse;


function render_to_response($template, $context)
{
    $t = new Template;
    $t->template = $template;
    return new HttpResponse($t->render(new Context($context)));
}


