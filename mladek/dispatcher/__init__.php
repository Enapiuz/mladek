<?php
namespace mladek::dispatcher;

use mladek::conf::urls::urls;
use mladek::http::Http404;
use mladek::http::HttpRequest;
::mladek::import(mladek::settings::ROOT_URLCONF);


class dispatch
{
    static function run()
    {
        ob_start();
        try {
            $route = urls::route();
            $url = $route['url'];
            $params = $route['params'];
            $params[0] = new HttpRequest();
            if (isset($url[2]) and is_array($url[2])) {
                $params = array_merge($url[2], $params);
            }
            ::mladek::autoload($url[1]);
            $response = call_user_func_array($url[1], $params);
            if (false === $response) {
                throw new ErrorException("Called view '$url[1]' not available.");
            }
        } catch (Exception $e) {
            $response = new Http404($e->getMessage());
        }
        $response->render();
    }
}



