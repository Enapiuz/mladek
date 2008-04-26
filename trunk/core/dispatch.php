<?php
namespace mladek::core;
use mladek::core::http;

class dispatch
{
    static function run()
    {
        ob_start();
        include_once conf::get('PROJECT_DIR').'/urls.php';
        try {
            mladek::core::urls::route();
        } catch (Exception $e) {
            http::response404($e->getMessage());
        }
    }
}



