<?php
function __autoload($class)
{
//    print $class.'---';
    if (0 === strpos($class, 'mladek')) {
        $path = __DIR__.'/../..';
    } else {
        $path = mladek::core::conf::get('PROJECT_DIR');
    }
    include_once realpath($path.'/'.str_replace('::', '/', $class).'.php');
}
