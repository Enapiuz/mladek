<?php
namespace mladek::conf;

final class conf
{
    static $conf = array();

    static function set($param, $value)
    {
        self::$conf[$param] = $value;
    }

    static function get($param)
    {
        return self::$conf[$param];
    }
    
    static function add_include_path($path)
    {
        set_include_path(get_include_path().PATH_SEPARATOR.realpath($path));
    }
}
