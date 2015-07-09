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
     * Return True falls das Password mit dem Sal und Hash übereinstimmt
     */
    private function testPassword($password, $saltFromDB, $hashFromDB) {
        //old (hash_hmac("sha256", $password, $saltFromDB) == $hashFromDB) {
        if (password_verify($password . $saltFromDB, $hashFromDB)) { // Standard PHP hashing Function benutzt
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verarbeitet Login
     */
    public function login($request) {
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
            if ($this->testPassword($in_password, $saltFromDB, $passwordFromDB)) { // Wenn Password übereinstimmt
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
