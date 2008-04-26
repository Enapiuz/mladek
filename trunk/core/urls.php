<?php
namespace mladek::core;
use mladek::core::conf;

final class urls
{
    static $urls = array();
    
    static function patterns()
    {
    
        $path = str_replace(
                    conf::get('REWRITE_BASE').'/',
                    '/',
                    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                    );
        self::$urls = func_get_args();
        foreach (self::$urls as $pattern) {
            $pattern[0] = str_replace('^', '^/', $pattern[0]);
            $pattern[0] = str_replace('/', '\\/', $pattern[0]);
            if (preg_match('/'.$pattern[0].'/', $path)) {
                if (!isset($pattern[2]) or !is_array($pattern[2])) {
                    $pattern[2] = array();
                }
                call_user_func_array($pattern[1], $pattern[2]);
                break;
            }
            throw new Exception('No url match');
        }
    }
    
    static function reverse()
    {
        $params = func_get_args();
        $name = array_shift($params);
        foreach (self::$urls as $url) {
            if ($name === $url['name'] or $name === $url[1]) {
                $link = $url[0];
                foreach ($params as $param) {
                    $link = preg_replace('/\(.*\)/', $param, $link, 1);
                }
                $link = str_replace('^', '/', substr($link, 0, -1));
                return $link;
                break;
            }
        }

    }
}
