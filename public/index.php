<?php

define('ROOT', dirname(dirname(__FILE__)));
require_once (ROOT . '/app/init.php');

$app = new App();
$app->init();