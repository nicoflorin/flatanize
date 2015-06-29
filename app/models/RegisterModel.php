<?php

/**
 * Verarbeitet die Registrierung
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
        //input sent from post
        $in_userName = $request['username'];
        $in_displayName = $request['displayname'];
        $in_email = $request['email'];
        $in_password = $request['password'];
        $in_wg_code = $request['wg_code'];

        $error = [];
        if (empty($in_userName)) {
            $error['username'] = "false";
        }
        if (empty($in_displayName)) {
            $error['displayname'] = "false";
        }
        if (empty($in_email)) {
            $error['email'] = "false";
        }
        if (empty($in_password)) {
            $error['password'] = "false";
        }
        //falls Fehler aufgetreten sind, $error Array zurückgeben
        if (!empty($error)) {
            
            // Korrekt Befüllte Felder wieder zurückgeben
            if (!empty($in_userName)) {
               $error["username"] = $in_userName;
            }
            if (!empty($in_displayName)) {
                $error["displayname"] = $in_displayName;
            }
            if (!empty($in_email)) {
                $error["email"] = $in_email;
            }

            // Return Error
            return $error;
        } else { // sonst User erstellen
            $salt = openssl_random_pseudo_bytes(64); //generate 512bit random string
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

            // Wenn keine Fehler auftraten
            return true;
        }
    }

}
