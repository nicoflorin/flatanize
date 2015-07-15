<?php

/**
 * Verarbeitet den Login eines Users
 *
 * @author Nico
 */
class LoginModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Verarbeitet Login
     */
    public function login($username, $password) {
        // Select auf diesen Usernamen
        $bind = array(':username' => $username);
        $res = $this->db->select('id, flats_id, password, salt', 'users', 'username = :username LIMIT 1', $bind);

        // Bei Treffer auf DB
        if (!empty($res)) { 
            $passwordFromDB = $res[0]['password'];
            $saltFromDB = $res[0]['salt'];
            $flatId = $res[0]['flats_id'];
            $userId = $res[0]['id'];

            // Vergleiche Input Password mit Hash, Salt aus DB
            if (Functions::testPassword($password, $saltFromDB, $passwordFromDB)) { // Wenn Password übereinstimmt
                //Schreibe User Session var
                Session::setUserId($userId);

                //Schreibe flat Session var
                if (isset($flatId)) {
                    Session::setFlatId($flatId);
                }
                
                return true;
            } else { //wenn Password falsch
                return false;
            }
        }
    }

}
