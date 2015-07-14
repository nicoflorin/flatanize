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
    public function login($request) {
        //@Todo nicht POST übergeben
        //username und password von Formular
        $in_userName = $request['l_username'];
        $in_password = $request['l_password'];

        // Select auf diesen Usernamen
        $bind = array(':username' => $in_userName);
        $res = $this->db->select('id, flats_id, password, salt', 'users', 'username = :username LIMIT 1', $bind);

        // Bei Treffer auf DB
        if (!empty($res)) { 
            $passwordFromDB = $res[0]['password'];
            $saltFromDB = $res[0]['salt'];
            $flatId = $res[0]['flats_id'];

            // Vergleiche Input Password mit Hash, Salt aus DB
            if (Functions::testPassword($in_password, $saltFromDB, $passwordFromDB)) { // Wenn Password übereinstimmt
                //Schreibe User Session var
                Session::set('user_id', $res[0]['id']);
                
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
