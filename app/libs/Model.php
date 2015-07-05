<?php

/**
 * Model Hauptklasse
 */
class Model {

    protected $db;

    function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

}
