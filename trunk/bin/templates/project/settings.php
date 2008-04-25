<?php
use mladek::core::conf;

define('MLADEK_DIR', ''); # without slash on end

require_once MLADEK_DIR.'/core/autoload.php';

conf::set('PROJECT_DIR', __DIR__);


// here will be settings


@include_once 'settings_local.php';
