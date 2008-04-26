<?php
use mladek::conf::conf;

define('MLADEK_DIR', ''); # without slash on end

require_once MLADEK_DIR.'/core/autoload.php';

conf::set('PROJECT_DIR', __DIR__); # without slash on end

conf::set('REWRITE_BASE', ''); # without slash on end

//conf::add_include_path('d:/anywhere');


// here will be settings


@include_once 'settings_local.php';
