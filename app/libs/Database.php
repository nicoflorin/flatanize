<?php

/**
 * Database Hauptklasse
 * Erweitert PDO Klasse (Datenbankzugriff)
 */
class Database extends PDO { //für extend PDO in php.ini: extension=php_pdo_mysql.dll enablen

    /**
     * Erstellt ein Database Objekt anhand der Informationen eines .ini File
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
        
        // setzte ErrorLevel
        // @ToDo entfernen bei Website upload
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    }

    /**
     * Gibt einen oder mehrere Datensätze zurück
     */
    public function select($fields = "*", $table, $where = "", $bind = array()) {
        if (!empty($table)) {
            $sql = "SELECT " . $fields . " FROM " . $table;
            if (!empty($where)) {
                $sql .= " WHERE " . $where;
            }
            $sql .= ";";
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Löscht einen Datensatz aus einer Tabelle
     */
    public function delete($table, $where = "", $bind = array()) {
        if (!empty($table)) {
            $sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Fügt einen neuen Datensatz in die Tabelle ein
     */
    public function insert($table, $fields, $values, $bind = array()) {
        if (!empty($table) && !empty($fields) && !empty($values)) {
            $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $values . ");";

            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Aktualisiert einen oder mehrere Datensätze
     */
    public function update($table, $fieldVal, $where = "", $bind = array()) {
        if (!empty($table) && !empty($fieldVal)) {
            $sql = "UPDATE " . $table . " SET " . $fieldVal;
            if (!empty($where)) {
                $sql .= " WHERE " . $where;
            }
            $sql .= ";";
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Führt ein SQL Statement aus
     */
    public function run($sql, $bind = array()) {
        $sql = trim($sql);
        try {
            $stmt = $this->prepare($sql);
            if ($stmt->execute($bind) !== false) {
                //Bei Select gib Datensätze zurück
                if (strpos($sql, 'SELECT') !== false) {
                    return $stmt->fetchAll();
                }
                // Sonst gib count zurück
                elseif (strpos($sql, 'DELETE') !== false || strpos($sql, 'INSERT') !== false || strpos($sql, 'UPDATE') !== false) {
                    return $stmt->rowCount();
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }

}
