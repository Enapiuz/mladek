<?php
namespace mladek::core;

class dispatch
{
    static function run()
    {
        include_once conf::get('PROJECT_DIR').'/urls.php';
    }
}



