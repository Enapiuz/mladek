<?php
use mladek::settings;
use mladek::conf::conf;

// Include your Doctrine configuration/setup here, your connections, models, etc.

// Configure Doctrine Cli
// Normally these are arguments to the cli tasks but if they are set here the arguments will be auto-filled and are not required for you to enter them.
require_once('doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));
Doctrine_Manager::connection(settings::DATABASE_ENGINE.':///'.settings::DATABASE_NAME.'?mode=0666');


$config = array('data_fixtures_path'  =>  '/path/to/data/fixtures',
                'models_path'         =>  array_map('mladek::get_path', conf::get('INSTALLED_APPS')),
                'migrations_path'     =>  '/path/to/migrations',
                'sql_path'            =>  '/path/to/data/sql',
                'yaml_schema_path'    =>  '/path/to/schema');
print_r($config);
$cli = new Doctrine_Cli($config);
$cli->run($_SERVER['argv']);
