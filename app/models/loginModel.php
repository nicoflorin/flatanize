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
        if (hash_hmac("sha256", $password, $saltFromDB) == $hashFromDB) {
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
        $res = $this->db->select('id, password, salt', 'users', 'username = :username LIMIT 1', $bind);

        // Bei Treffer auf DB
        if (!empty($res)) { 
            $passwordFromDB = $res[0]['password'];
            $saltFromDB = $res[0]['salt'];

            // Vergleiche Input Password mit Hash, Salt aus DB
            if ($this->testPassword($in_password, $saltFromDB, $passwordFromDB)) {
                Session::set('user_id', $res[0]['id']);
                return true;
            } else {
                return false;
            }
        }
    }

}
