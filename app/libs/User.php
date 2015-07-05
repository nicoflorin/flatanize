<?php

class UserModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Verlinkt einen User mit einer Flat
     */
    public function linkUserToFlat($user_id, $flat_id) {
        $bind = array(
            ':user_id' => $user_id,
            ':flat_id' => $flat_id
        );
        $res = $this->db->update('users', 'flat_id = :flat_id', 'id = :user_id', $bind);
    }

}
