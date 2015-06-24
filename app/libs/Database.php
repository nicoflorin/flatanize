<?php

class Database extends PDO {

    public function __construct($file = ROOT . '/app/configs/settings.ini') {
        
        if (!$settings = parse_ini_file($file, TRUE)) {
            throw new exception('Unable to open ' . $file . '.');
        }

        $dsn = $settings['database']['driver'] .
                ':host=' . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
                ';dbname=' . $settings['database']['db'];
        echo $dsn;
        
        // Erstelle PDO Objekt
        parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
    }

}
