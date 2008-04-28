<?php
namespace mladek;

spl_autoload_register('mladek::autoload');


function autoload($class, $strip = true)
{
//        print $class.'---';
    $path = get_path($class, $strip);
    $init_file = realpath($path.'/__init__.php');
    $file = realpath($path.'.php');
    if ($init_file) {
        include_once $init_file;
    } elseif ($file) {
        include_once $file;
    }
}


function import($namespace_path)
{
    autoload($namespace_path, false);
}


function get_path($namespace_path, $strip = false)
{
    static $project_dir_name, $project_name, $project_dir;

    if (0 === strpos($namespace_path, 'mladek')) {
        // path for mladek classes
        $path = __DIR__.'/../';
    } else {
        if (!isset($project_dir_name) or !isset($project_name)) {
            $project_dir = mladek::settings::PROJECT_DIR;
            if (false !== $pos1 = strrpos(str_replace(DIRECTORY_SEPARATOR, '/', $project_dir), '/')) {
                $project_dir_name = substr($project_dir, $pos1+1);
            }
            if (false !== $pos2 = strpos($namespace_path, '::')) {
                $project_name = substr($namespace_path, 0, $pos2);
            }
        }
        if ($project_dir_name === $project_name) {
            // path for classes in project
            $path = $project_dir.'/../';
        } else {
            // path for other classes in include path
            $path = '';
        }
    }
    if ($strip) {
        $namespace_path = preg_replace('/::[^(::)]+$/', '', $namespace_path);
    }
    $path = $path.str_replace('::', '/', $namespace_path);
    if (false !== $realpath = realpath($path)) {
        return $realpath;
    } else {
        return $path;
    }
}
