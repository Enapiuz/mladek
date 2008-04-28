<?php
namespace mladek::conf::urls;
use mladek::settings;

final class urls
{

    static $urls = array();
    static $path = '';
    static $deep = 0;

    static function getPath()
    {
        return str_replace(
                            settings::REWRITE_BASE.'/',
                            '/',
                            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                            );
    }
    
    static function patterns($args = array())
    {
        self::$deep++;
        foreach ($args as $pattern) {
            if (is_array($pattern[1])) {
                foreach (self::$urls[(self::$deep-1)] as $url) {
                    $url[0] = $pattern[0].substr($url[0], 1);
                    $url[1] = $pattern[1][0].'::'.$url[1];
                    self::$urls[self::$deep][] = $url;
                    unset(self::$urls[(self::$deep-1)]);
                }
            } else {
                self::$urls[self::$deep][] = $pattern;
            }
         }
    }
    
    static function route()
    {
        self::$urls = array_shift(self::$urls);
//        print_r(nl2br(print_r(self::$urls, true)));
        $path = self::getPath();
        foreach (self::$urls as $url) {
            $url[0] = str_replace('^', '^/', $url[0]);
            $url[0] = str_replace('/', '\/', $url[0]);
            if (preg_match('/'.$url[0].'/', $path, $params)) {
                return array('url' => $url, 'params' => $params);
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
                    throw new ErrorException(sprintf('Route %s needs %s parameters. %s provided.', $name, $needed_params, $provided_params));
                }
                $link = str_replace('^', '/', substr($link, 0, -1));
                return $link;
                break;
            }
        }
    }
        
    static function inc($namespace_path)
    {
        $prefix = preg_replace('/::[^(::).]+$/', '', $namespace_path);
        $suffix = preg_replace('/^.+::/', '', $namespace_path);
        self::$path .= str_replace('::', '/', $prefix).'/';
        $file = realpath(settings::PROJECT_DIR.'/../'.self::$path.$suffix.'.php');
        if (include_once $file) {
            return array($prefix);
        } else {
            throw new ErrorException('Error when include file '.$file);
        }
    }
}
