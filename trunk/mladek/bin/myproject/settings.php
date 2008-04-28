<?php
namespace mladek::settings;

use mladek::conf::conf;


const MLADEK_DIR = ''; # without slash on end

require_once MLADEK_DIR.'/__init__.php';

const PROJECT_DIR = __DIR__; # without slash on end

const REWRITE_BASE = ''; # without slash on end

conf::add_include_path(MLADEK_DIR.'/../libs');



const DATABASE_ENGINE = 'sqlite';
const DATABASE_NAME = '';
const DATABASE_USER = '';
const DATABASE_PASSWORD = '';
const DATABASE_HOST = '';
const DATABASE_PORT = '';

const ROOT_URLCONF = 'myproject::urls';

conf::set('INSTALLED_APPS', array(
));


@include_once 'settings_local.php';
