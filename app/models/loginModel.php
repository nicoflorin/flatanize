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
     * @param type $saltFromDB
     * @return type
     */
    private function testPassword($password, $saltFromDB, $hashFromDB) {
        if (hash_hmac("sha256", $password, $saltFromDB) == $hashFromDB) {
            return true;
        } else {
            return false;
        }
    }

    public function login($request) {
        //username und password von Formular
        $in_userName = $request['username'];
        $in_password = $request['password'];

        $st = $this->db->prepare("SELECT password, salt FROM users WHERE username = :username LIMIT 1");
        $st->execute(array(':username' => $in_userName));
        $res = $st->fetch(PDO::FETCH_ASSOC);

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
