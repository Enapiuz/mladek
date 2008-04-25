<?php
namespace mladek::core;

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
}
