<?php

/**
 * Verarbeitet die Registrierung eines Benutzers
 */
class RegisterModel extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Prüft Benutzer Eingaben und erstellt den User in der DB.
     * @param array $request
     */
    public function register(array $request) {
        // @Todo doppelte User prüfen
        //input sent from post
        $in_userName = $request['username'];
        $in_displayName = $request['displayname'];
        $in_email = $request['email'];
        $in_password = $request['password'];
        $in_flat_code = $request['flat_code'];

        $error = [];
        if (empty($in_userName)) {
            $error['username'] = true;
        }
        if (empty($in_displayName)) {
            $error['displayname'] = true;
        }
        if (empty($in_email)) {
            $error['email'] = true;
        }
        if (empty($in_password)) {
            $error['password'] = true;
        }

        // Prüfe ob User oder email Adresse bereits existiert
        $bind = array(
            ':username' => $in_userName,
            ':email' => $in_email
        );
        $count = $this->db->select('count(*) as cnt', 'users', 'username = :username OR email = :email', $bind);
        if ($count[0]['cnt'] > 0) {
            $error['dupl_user'] = true;
            
        }

        //falls Eingabe Fehler aufgetreten sind, $error Array zurückgeben
        if (!empty($error)) {
            if (isset($error['dupl_user'])) {
                $error['error_msg'] = 'Username or Email Adress already exists! Please choose another one.';
            }else {
                $error['error_msg'] = 'Please provide all required informations!';
            }

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
            $salt = openssl_random_pseudo_bytes(64); //Generiere Random String
            $hashed_password = hash_hmac("sha256", $in_password, $salt); // Hashe Passwort mit Salt

            $bind = array(
                ':username' => $in_userName,
                ':display_name' => $in_displayName,
                ':email' => $in_email,
                ':password' => $hashed_password,
                ':salt' => $salt
            );
            // Füre DB Insert aus
            $this->db->insert('users', 'username, display_name, email, password, salt', ':username, :display_name, :email, :password, :salt', $bind);

            // Falls ein Flat Code eingegeben wurde, den User gleich mit dieser WG verlinken
            if (!empty($in_flat_code)) {
                /*
                  $stmt = $this->db->prepare("SELECT id FROM flats WHERE code = :flat_code");
                  $stmt->execute(array(':flat_code' => $in_flat_code));
                  $res = $stmt->fetch(PDO::FETCH_ASSOC);
                 */

                $bind = array(':flat_code' => $in_flat_code);
                $res = $this->db->select('id', 'flats', 'code = :flat_code', $bind);
                $id = $res[0]['id'];

                $bind = array(
                    ':id' => $id,
                    ':username' => $in_userName
                );
                $res = $this->db->update('users', 'flat_id = :id', 'username = :username', $bind);
            }

            // Wenn keine Fehler auftraten
            return true;
        }
    }

}
