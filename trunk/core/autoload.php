<?php
function __autoload($class)
{
//     print $class.'---';
    static $project_dir_name, $project_name, $project_dir;

    if (0 === strpos($class, 'mladek')) {
        // autoload for mladek classes
        $path = __DIR__.'/../../';
    } else {
        if (!isset($project_dir_name)) {
            $project_dir = mladek::conf::conf::get('PROJECT_DIR');
            if (false !== $pos1 = strrpos(str_replace(DIRECTORY_SEPARATOR, '/', $project_dir), '/')) {
                $project_dir_name = substr($project_dir, $pos1+1);
            }
            if (false !== $pos2 = strpos($class, '::')) {
                $project_name = substr($class, 0, $pos2);
            }
        }
        if ($project_dir_name === $project_name) {
            // autoload for classes in project
            $path = $project_dir.'/../';
        } else {
            // autoload for other classes in include path
            $path = '';
        }
    }
    $class = preg_replace('/::[^(::)]+$/', '', $class);
    $init_path = realpath($path.str_replace('::', '/', $class).'/__init__.php');
    if ($init_path) {
        include_once $init_path;
    } else {
        include_once realpath($path.str_replace('::', '/', $class).'.php');
    }
}
