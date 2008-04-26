<?php
require_once __DIR__.'/../utils/filesystem.php';

switch ($argv[1]) {
    case 'startproject':
        copy_recursive(__DIR__.'/templates/project', $argv[2], array('.svn'));
        $settings = preg_replace(
                                    "/define\('MLADEK_DIR', '.*'\)/",
                                    "define('MLADEK_DIR', '".str_replace('\\', '/', realpath(__DIR__.'/../'))."')",
                                    file_get_contents(__DIR__.'/templates/project/settings.php')
                                );
        file_put_contents($argv[2].'/settings.php', $settings);
        break;
    default:
        print "Unknown command '{$argv[1]}'\n";
        print "For creating new project run: php <path_to_mladek>/mladek/bin/mladek-admin.php startproject <my_project>\n";
}
