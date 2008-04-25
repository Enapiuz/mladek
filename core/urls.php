<?php
namespace mladek::core;

final class urls
{
    static function patterns()
    {
        foreach (func_get_args() as $pattern) {
            if (!isset($pattern[2]) or !is_array($pattern[2])) {
                $pattern[2] = array();
            }
            call_user_func_array($pattern[1], $pattern[2]);
        }
    }
}
