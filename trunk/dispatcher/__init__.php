<?php
namespace mladek::dispatcher;
use mladek::conf::conf;
use mladek::conf::urls::urls;
use mladek::http::Http404;

class dispatch
{
    static function run()
    {
        ob_start();
        include_once conf::get('PROJECT_DIR').'/urls.php';
        try {
            $response = urls::route();
        } catch (Exception $e) {
            $response = new Http404($e->getMessage());
        }
        $response->render();
    }
}



