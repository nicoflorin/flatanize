<?php

/**
 * Verarbeitet den Login eines Users
 *
 * @author Nico
 */
class Login extends Model {

    public function __construct() {
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

        $st = $this->db->prepare("SELECT password, salt FROM users WHERE username = :username LIMIT 1");
        $st->execute(array(':username' => $in_userName));
        $res = $st->fetch(PDO::FETCH_ASSOC); // Gibt Tabelle mit key zurück

        $passwordFromDB = $res['password'];
        $saltFromDB = $res['salt'];

        // Vergleiche Input Password mit Hash, Salt aus DB
        //compare input password with hash,salt from DB
        if ($this->testPassword($in_password, $saltFromDB, $passwordFromDB)) {
            return true;
        } else {
            return false;
        }
    }

}
