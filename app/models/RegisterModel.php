<?php

/**
 * Verarbeitet die Registrierung
 *
 * @author Nico
 */
class Register extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Prüft Benutzer Eingaben und erstellt den User in der DB.
     * @param array $request
     */
    public function register(array $request) {
        print_r($request);

        //input sent from post
        $in_userName = $request['username'];
        $in_displayName = $request['displayname'];
        $in_email = $request['email'];
        $in_password = $request['password'];
        $in_wg_code = $request['wg_code'];

        $salt = openssl_random_pseudo_bytes(64); //generate 265bit random string
        $hashed_password = hash_hmac("sha256", $in_password, $salt);

        $st = $this->db->prepare(
                "INSERT INTO users (username, display_name, email, password, salt) "
                . "VALUES (:username, :display_name, :email, :password, :salt);"
        );
        $st->execute(array(
            ':username' => $in_userName,
            ':display_name' => $in_displayName,
            ':email' => $in_email,
            ':password' => $hashed_password,
            ':salt' => $salt,
        ));

    }

}
