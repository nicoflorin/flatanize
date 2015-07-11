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
            ':userId' => $userId,
            ':flatId' => $flatId
        );
        $res = $this->db->update('users', 'flats_id = :flatId', 'id = :userId', $bind);
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

    /**
     * Holt alle DisplayNames einer WG aus der DB
     * @param type $flatId
     * @return array
     */
    public function getAllDisplayNames($flatId) {
        $bind = array(
            ':flatId' => $flatId,
        );
        $res = $this->db->select('id, display_name', 'users', 'flats_id = :flatId', $bind);
        $usersName = array();
        
        //Erstelle Array Array ( [1] => Name [2] => Name2 ) 
        foreach ($res as $user) {
            $usersName[$user['id']] = $this->getDisplayName($user['id']);
        }
        if (!empty($usersName)) {
            return $usersName;
        } else {
            return array();
        }
    }

}
