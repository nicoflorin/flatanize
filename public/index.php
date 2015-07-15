<?php
/**
 * Haupt-Einstiegspunkt.
 * Alle Zugriffe werden über diese Datei geroutet.
 */

//Konstante für ROOT Verzeichnis (Filestruktur)
define('ROOT', realpath(dirname(__DIR__))); // realpath gibt eindeutigen und absoluten Pfadnamen zurück

//Configs
require_once (ROOT . '/app/configs/consts.php');

/**
 * Autoloader
 * Lädt automatisch alle benötigten Klassen
 * @param string $class
 */
function __autoload($class) {
    require_once ROOT . '/app/libs/' . $class . '.php';
}
//Library
//@Todo entfernen
//require_once (ROOT . '/app/libs/App.php');
//require_once (ROOT . '/app/libs/Controller.php');
//require_once (ROOT . '/app/libs/Database.php');
//require_once (ROOT . '/app/libs/Model.php');
//require_once (ROOT . '/app/libs/Session.php');
//require_once (ROOT . '/app/libs/View.php');
//require_once (ROOT . '/app/libs/Functions.php');

// Starte Hauptscript
$app = new App();
$app->init();