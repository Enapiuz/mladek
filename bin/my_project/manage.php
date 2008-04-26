<?php
require_once __DIR__.'/settings.php';
require_once MLADEK_DIR.'/utils/filesystem.php';

switch ($argv[1]) {
    case 'startapp':
        copy_recursive(MLADEK_DIR.'/bin/my_project/my_app', $argv[2]);
        break;
    default:
        print "Unknown command '{$argv[1]}'\n";
        print "For creating new application run: php manage.php startapp <my_app>\n";
}
