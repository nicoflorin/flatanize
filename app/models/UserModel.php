<?php

class UserModel extends Model {

    private $id;
    private $flat_id;
    private $name;

    function __construct() {
        parent::__construct();
    }

    function getName() {
        return $this->name;
    }

    function setName($value) {
        $this->name = $value;
    }

    /**
     * 
     */
    public function linkUserToFlat($user_id, $flat_id) {
        $bind = array(
            ':user_id' => $user_id,
            ':flat_id' => $flat_id
        );
        $res = $this->db->update('users', 'flat_id = :flat_id', 'id = :user_id', $bind);
    }

}
