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
    public function login($username, $password, $remember) {
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
            if (Functions::testHash($password, $saltFromDB, $passwordFromDB)) { // Wenn Password übereinstimmt
                //Falls remember me gesetzt, token in db und als cookie speichern
                if ($remember === true) {
                    $random = Functions::generateRandomData(64);
                    $token = Functions::hash($random);

                    //Speichere Token in DB
                    $bind = array(
                        ':userId' => $userId,
                        ':token' => $token
                    );
                    $res = $this->db->update('users', 'token = :token', 'id = :userId', $bind);
                    $expire = 3600 * 24 * 365; //1 year
                    //Setze Cookie
                    Cookie::set('token', $token, $expire);
                }

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
