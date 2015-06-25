<?php

/**
 * Database Hauptklasse
 * Erweitert PDO Klasse (Datenbankzugriff)
 */
class Database extends PDO { //für extend PDO in php.ini: extension=php_pdo_mysql.dll enablen
    /**
     * Erstellt ein Database Objekt anhand der Informationen eines .ini File
     * @param type $file
     * @throws exception
     */
    public function __construct($file = ROOT . '/app/configs/settings.ini') {
        
        // Falls ini File vorhanden, parsen und in settings Array schreiben
        if (!$settings = parse_ini_file($file, TRUE)) {
            throw new exception('Unable to open ' . $file . '.');
        }

        // verknüpfe Settings zu dsn String
        $dsn = $settings['database']['driver'] .
                ':host=' . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
                ';dbname=' . $settings['database']['db'];
        
        // Erstelle PDO Objekt
        parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
    }

}
