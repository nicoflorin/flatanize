<?php

/**
 * Model Parent-Klasse. Von dieser Klasse erben alle weiteren Models.
 * 
 * @author Nico
 */
class Model {

    //Property um Datenbankverbidung zu speichern
    protected $db;

    function __construct() {
        //Datenbank Instanzieren und Verbindung herstellen
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

}
