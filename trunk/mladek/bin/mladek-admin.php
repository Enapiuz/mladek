<?php
require_once __DIR__.'/../utils/filesystem.php';

switch ($argv[1]) {
    case 'startproject':
        copy_recursive(__DIR__.'/myproject', $argv[2], array('.svn'));
        $settings = preg_replace(
                                    "/define\('MLADEK_DIR', '.*'\)/",
                                    "define('MLADEK_DIR', '".str_replace('\\', '/', realpath(__DIR__.'/../'))."')",
                                    file_get_contents(__DIR__.'/myproject/settings.php')
                                );
        file_put_contents($argv[2].'/settings.php', $settings);
        print "Please set 'RewriteBase' in your $argv[2]/www/.htaccess file.\n";
        print "Please set 'REWRITEBASE' in your $argv[2]/www/settings.php file to same value without end slash.\n";
        break;
    default:
        print "Unknown command '{$argv[1]}'\n";
        print "For creating new project run: php <path_to_mladek>/mladek/bin/mladek-admin.php startproject <myproject>\n";
}
