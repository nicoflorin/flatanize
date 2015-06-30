<?php

/**
 * Verarbeitet die Registrierung eines Benutzers
 */
class Register extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Prüft Benutzer Eingaben und erstellt den User in der DB.
     * @param array $request
     */
    public function register (array $request) {
        // @Todo doppelte User prüfen
        
        //input sent from post
        $in_userName = $request['username'];
        $in_displayName = $request['displayname'];
        $in_email = $request['email'];
        $in_password = $request['password'];
        $in_flat_code = $request['flat_code'];

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
