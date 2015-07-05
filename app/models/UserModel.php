<?php

class UserModel {

    private $name;

    function __construct() {
        try {
            $db = new Database();
            echo '<br />DB connect successfull!';
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    function getName() {
        return $this->name;
    }

    function setName($value) {
        $this->name = $value;
    }

}
