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
        //input sent from post
        $in_userName = $request['username'];
        $in_displayName = $request['displayname'];
        $in_email = $request['email'];
        $in_password = $request['password'];
        $in_flat_code = $request['flat_code'];

        $error = [];
        if (empty($in_userName)) {
            $error['username'] = true;
            $error['error_id'] = 3;
        }
        if (empty($in_displayName)) {
            $error['displayname'] = true;
            $error['error_id'] = 3;
        }
        if (empty($in_email)) {
            $error['email'] = true;
            $error['error_id'] = 3;
        }
        if (empty($in_password)) {
            $error['password'] = true;
            $error['error_id'] = 3;
        }

        // Prüfe ob User oder email Adresse bereits existiert
        $bind = array(
            ':username' => $in_userName,
            ':email' => $in_email
        );
        $count = $this->db->select('count(*) as cnt', 'users', 'username = :username OR email = :email', $bind);
        if ($count[0]['cnt'] > 0) {
            $error['error_id'] = 1;
        }

        //Falls Flat eingegebn, Prüfe ob Flat existiert
        if (!empty($in_flat_code)) {
            $bind = array(':flat_code' => $in_flat_code);
            $res = $this->db->select('id', 'flats', 'code = :flat_code', $bind);
            if (empty($res)) {
                $error['error_id'] = 2;
            } else {
                $flat_id = $res[0]['id'];
            }
        }

        //falls Eingabe Fehler aufgetreten sind, $error Array zurückgeben
        if (!empty($error)) {
            if (isset($error['error_id'])) {
                switch ($error['error_id']) {
                    case 1:
                        $error['error_msg'] = 'Username or Email Adress already exists! Please choose another one.';
                        break;
                    case 2:
                        $error['error_msg'] = 'Flat Code not valid!';
                        break;
                    default:
                        $error['error_msg'] = 'Please provide all required informations!';
                        break;
                }
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
            if (!empty($flat_id)) {
                $user_id = $this->db->lastInsertId(); // Id des erstellen Users
                require_once ROOT . '/app/models/userModel.php';
                $user = new UserModel();
                $user->linkUserToFlat($user_id, $flat_id);
            }

            // Wenn keine Fehler auftraten
            return true;
        }
    }

}
