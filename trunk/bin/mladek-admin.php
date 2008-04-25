<?php
require_once __DIR__.'/../utils/filesystem.php';

switch ($argv[1]) {
    case 'startproject':
        $settings = file_get_contents(__DIR__.'/templates/project/settings.php');
        $settings = preg_replace("/define\('MLADEK_DIR', '(.)*'\)/", "define('MLADEK_DIR', '".str_replace('\\', '/', realpath(__DIR__.'/../'))."')", $settings);
        file_put_contents(__DIR__.'/templates/project/settings.php', $settings);
        copy_recursive(__DIR__.'/templates/project', $argv[2]);
        break;
    default:
        print "Unknown command '{$argv[1]}'\n";
        print "For creating new project run: php <path_to_mladek>/mladek/bin/mladek-admin.php startproject <your_project_dir_name>\n";
}
