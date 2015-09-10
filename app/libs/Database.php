<?php

/**
 * Database Parent-Klasse
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
                ';dbname=' . $settings['database']['db'] .
                ';charset=' . $settings['database']['charset'];

        // Erstelle PDO Objekt
        parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
        
        // setze ErrorLevel
        // nur für debugging
        // $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Gibt einen oder mehrere Datensätze zurück
     * @param string $fields    default "*"
     * @param string $table
     * @param string $where     default ""
     * @param array $bind
     * @return array/boolean
     */
    public function select($fields = "*", $table, $where = "", $bind = array()) {
        //Parameter prüfen
        if (!empty($table)) {
            //Select zusammenbauen
            $sql = "SELECT " . $fields . " FROM " . $table;
            if (!empty($where)) {
                $sql .= " WHERE " . $where;
            }
            $sql .= ";";
            //Statement ausführen und zurückgeben
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Löscht einen Datensatz aus einer Tabelle
     * @param string $table
     * @param string $where     default ""
     * @param array $bind
     * @return array/boolean
     */
    public function delete($table, $where = "", $bind = array()) {
        //Parameter prüfen
        if (!empty($table)) {
            //Delete zusammenbauen
            $sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
            //Statement ausführen und zurückgeben
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Fügt einen neuen Datensatz in die Tabelle ein
     * @param string $table
     * @param string $fields
     * @param string $values
     * @param array $bind
     * @return array/boolean
     */
    public function insert($table, $fields, $values, $bind = array()) {
        //Parameter prüfen
        if (!empty($table) && !empty($fields) && !empty($values)) {
            //Insert zusammenbauen
            $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $values . ");";
            //Statement ausführen und zurückgeben
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Aktualisiert einen oder mehrere Datensätze
     * @param string $table
     * @param string $fieldVal
     * @param string $where     default ""
     * @param array $bind
     * @return array/boolean
     */
    public function update($table, $fieldVal, $where = "", $bind = array()) {
        //Parameter prüfen
        if (!empty($table) && !empty($fieldVal)) {
            //Update zusammenbauen
            $sql = "UPDATE " . $table . " SET " . $fieldVal;
            if (!empty($where)) {
                $sql .= " WHERE " . $where;
            }
            $sql .= ";";
            //Statement ausführen und zurückgeben
            return $this->run($sql, $bind);
        } else {
            return false;
        }
    }

    /**
     * Führt ein SQL Statement aus
     * @param string $sql
     * @param array $bind
     * @return array/boolean
     */
    public function run($sql, $bind = array()) {
        $sql = trim($sql);
        try {
            //Statement vorbereiten
            $stmt = $this->prepare($sql);
            //Statement ausführen und Resultat prüfen
            if ($stmt->execute($bind) !== false) {
                //Bei Select gib Datensätze zurück
                if (strpos($sql, 'SELECT') !== false) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                // Sonst gib anzahl geänderte Datensätze zurück
                elseif (strpos($sql, 'DELETE') !== false || strpos($sql, 'INSERT') !== false || strpos($sql, 'UPDATE') !== false) {
                    return $stmt->rowCount();
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }

}
