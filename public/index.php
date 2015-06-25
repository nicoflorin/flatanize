<?php
/**
 * Haupt-Einstiegspunkt.
 * Alle Zugriffe werden über diese Datei geroutet.
 */
define('ROOT', realpath(dirname(__DIR__))); // realpath gibt eindeutigen und absoluten Pfadnamen zurück
require_once (ROOT . '/app/init.php');

// Starte Hauptscript
$app = new App();
$app->init();