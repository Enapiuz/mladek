<?php
require_once __DIR__.'/../utils/filesystem.php';

switch ($argv[1]) {
    case 'startproject':
        copy(__DIR__.'/templates/project/settings.php', __DIR__.'/templates/project/tmp/settings.php.bak');
        $settings = file_get_contents(__DIR__.'/templates/project/settings.php');
        $settings = preg_replace("/define\('MLADEK_DIR', '.*'\)/", "define('MLADEK_DIR', '".str_replace('\\', '/', realpath(__DIR__.'/../'))."')", $settings);
        file_put_contents(__DIR__.'/templates/project/settings.php', $settings);
        copy_recursive(__DIR__.'/templates/project', $argv[2], array('.svn'));
        copy(__DIR__.'/templates/project/tmp/settings.php.bak', __DIR__.'/templates/project/settings.php');
        unlink(__DIR__.'/templates/project/tmp/settings.php.bak');
        break;
    default:
        print "Unknown command '{$argv[1]}'\n";
        print "For creating new project run: php <path_to_mladek>/mladek/bin/mladek-admin.php startproject <my_project>\n";
}
