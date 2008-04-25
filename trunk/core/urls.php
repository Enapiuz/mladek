<?php
namespace mladek::core;

final class urls
{
    static function patterns()
    {
        foreach (func_get_args() as $pattern) {
            call_user_func_array($pattern[1], $pattern[2]);
        }
    }
}
