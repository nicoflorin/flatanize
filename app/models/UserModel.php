<?php

class UserModel extends Model{

    private $id;
    private $flat_id;
    private $name;

    function __construct() {
        parent::construct();
    }

    function getName() {
        return $this->name;
    }

    function setName($value) {
        $this->name = $value;
    }

}
