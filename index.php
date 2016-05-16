<?php

require_once './system/Config.php';
require_once './system/Autoload.php';

$app = new App;
$app->set('welcome');
$app->init();
