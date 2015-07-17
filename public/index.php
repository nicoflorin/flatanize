<?php
/**
 * Haupt-Einstiegspunkt.
 * Alle Zugriffe werden über diese Datei geroutet.
 */

//Konstante für ROOT Verzeichnis (Filestruktur)
define('ROOT', realpath(dirname(__DIR__))); // realpath gibt eindeutigen und absoluten Pfadnamen zurück

//Configs
require_once (ROOT . '/app/configs/config.php');

/**
 * Autoloader
 * Lädt automatisch alle benötigten Klassen
 * @param string $class
 */
function __autoload($class) {
    require_once ROOT . '/app/libs/' . $class . '.php';
}

// Starte Hauptscript
$app = new App();
$app->init();