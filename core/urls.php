<?php
namespace mladek::core;
use mladek::core::conf;

final class urls
{

    static $urls = array();

    static function getPath()
    {
        return str_replace(
                            conf::get('REWRITE_BASE').'/',
                            '/',
                            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                            );
    }
    
    static function patterns($args = array())
    {
        static $deep = 0;
        $deep++;
        foreach ($args as $pattern) {
            if (is_array($pattern[1])) {
                foreach (self::$urls[($deep-1)] as $url) {
                    $url[0] = $pattern[0].substr($url[0], 1);
                    $url[1] = $pattern[1][0].'::'.$url[1];
                    self::$urls[$deep][] = $url;
                    unset(self::$urls[($deep-1)]);
                }
            } else {
                self::$urls[$deep][] = $pattern;
            }
         }
    }
    
    static function route()
    {
        self::$urls = array_shift(self::$urls);
        print_r(nl2br(print_r(self::$urls, true)));
        $path = self::getPath();
        foreach (self::$urls as $url) {
            $url[0] = str_replace('^', '^/', $url[0]);
            $url[0] = str_replace('/', '\\/', $url[0]);
            if (preg_match('/'.$url[0].'/', $path)) {
                if (!isset($url[2]) or !is_array($url[2])) {
                    $url[2] = array();
                }
                if (false === call_user_func_array($url[1], $url[2])) {
                    throw new ErrorException("Called views '$url[1]' not available.");
                }
                return;
            }
        }
        throw new Exception('No url match');
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
                $needed_params = substr_count($url[0], '(');
                $provided_params = count($params);
                if ($needed_params > $provided_params) {
                    throw new ErrorException(sprintf('Route %s needs %s parameters. Only %s provided.', $name, $needed_params, $provided_params));
                }
                $link = str_replace('^', '/', substr($link, 0, -1));
                return $link;
                break;
            }
        }
    }
        
    static function inc($namespace_path)
    {
        $file = realpath(conf::get('PROJECT_DIR').'/../'.str_replace('::', '/', $namespace_path).'.php');
        if (include_once $file) {
            return array(preg_replace('/::[^(::).]+$/', '', $namespace_path));
        } else {
            throw new ErrorException('Error when include file '.$file);
        }
    }
}
