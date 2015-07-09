<?php

class UserModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Verlinkt einen User mit einer Flat
     */
    public function linkUserToFlat($userId, $flatId) {
        $bind = array(
            ':user_id' => $userId,
            ':flat_id' => $flatId
        );
        $res = $this->db->update('users', 'flat_id = :flat_id', 'id = :user_id', $bind);
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Holt den Displaynamen eines Users aus der DB
     * @param type $userId
     */
    public function getDisplayName($userId) {
        $bind = array(
            ':user_id' => $userId,
        );
        $res = $this->db->select('display_name', 'users', 'id = :user_id LIMIT 1', $bind);
        if (!empty($res)) {
            return $res[0]['display_name'];
        } else {
            return false;
        }
    }

}
