<?php
/**
 * Haupt-Einstiegspunkt.
 * Alle Zugriffe werden über diese Datei geroutet.
 */
define('ROOT', realpath(dirname(__DIR__))); // realpath gibt eindeutigen und absoluten Pfadnamen zurück

//Library
require_once (ROOT . '/app/libs/App.php');
require_once (ROOT . '/app/libs/Controller.php');
require_once (ROOT . '/app/libs/Database.php');
require_once (ROOT . '/app/libs/Model.php');
require_once (ROOT . '/app/libs/View.php');

//Configs
require_once (ROOT . '/app/configs/paths.php');

// Starte Hauptscript
$app = new App();
$app->init();