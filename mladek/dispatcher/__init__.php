<?php
namespace mladek::dispatcher;
use mladek::conf::conf;
use mladek::conf::urls::urls;
use mladek::http::Http404;
use mladek::http::HttpRequest;

class dispatch
{
    static function run()
    {
        ob_start();
        include_once conf::get('PROJECT_DIR').'/urls.php';
        try {
            $route = urls::route();
            $url = $route['url'];
            $params = $route['params'];
            $params[0] = new HttpRequest();
            if (isset($url[2]) and is_array($url[2])) {
                $params = array_merge($url[2], $params);
            }
            ::__autoload($url[1]);
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



