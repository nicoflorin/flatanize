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
    public function register($userName, $displayName, $email, $password, $flatCode = "") {


        $error = [];
        if (empty($userName)) {
            $error['username'] = true;
            $error['error_id'] = 1;
        }
        if (empty($displayName)) {
            $error['displayname'] = true;
            $error['error_id'] = 1;
        }
        if (empty($email)) {
            $error['email'] = true;
            $error['error_id'] = 1;
        }
        if (empty($password)) {
            $error['password'] = true;
            $error['error_id'] = 1;
        }

        // Prüfe ob User oder email Adresse bereits existiert
        $bind = array(
            ':username' => $userName,
            ':email' => $email
        );
        $count = $this->db->select('count(*) as cnt', 'users', 'username = :username OR email = :email', $bind);
        // Falls ein Eintrag gefunden wurde, existiert User bereits
        if ($count[0]['cnt'] > 0) {
            $error['error_id'] = 2;
        }

        //Falls Flat eingegebn, Prüfe ob Flat existiert
        if (!empty($flatCode)) {
            $bind = array(':flat_code' => $flatCode);
            $res = $this->db->select('id', 'flats', 'code = :flat_code', $bind);
            if (empty($res)) {
                $error['error_id'] = 3;
            } else {
                $flat_id = $res[0]['id'];
            }
        }

        //falls Eingabe Fehler aufgetreten sind, $error Array befüllen
        if (!empty($error)) {
            if (isset($error['error_id'])) {
                $error['error_msg'] = $this->setErrorMsg($error['error_id']); // Setze Fehlermeldung
            }

            // Korrekt Befüllte Felder wieder zurückgeben
            if (!empty($userName)) {
                $error["username"] = $userName;
            }
            if (!empty($displayName)) {
                $error["displayname"] = $displayName;
            }
            if (!empty($email)) {
                $error["email"] = $email;
            }

            // Return Error
            return $error;
        } else { // sonst User erstellen
            $salt = openssl_random_pseudo_bytes(64); //Generiere Random String
            // old $hashed_password = hash_hmac("sha256", $password, $salt); // Hashe Passwort mit Salt
            $hashed_password = password_hash($password . $salt, PASSWORD_BCRYPT); //Standard PHP Hashing function benutzt bcrypt (länge 60 zeichen)

            $bind = array(
                ':username' => $userName,
                ':display_name' => $displayName,
                ':email' => $email,
                ':password' => $hashed_password,
                ':salt' => $salt
            );
            // Füre DB Insert aus
            $res = $this->db->insert('users', 'username, display_name, email, password, salt', ':username, :display_name, :email, :password, :salt', $bind);


            // Falls ein Flat Code eingegeben wurde, den User gleich mit dieser WG verlinken
            if (!empty($flat_id)) {
                $user_id = $this->db->lastInsertId(); // Id des erstellen Users
                $user = new UserModel();
                $user->linkUserToFlat($user_id, $flat_id);
            }

            // Wenn keine Fehler auftraten
            if ($res == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Gibt anhand eines Errorcodes die entsprechende Fehlermeldung zurück
     * @param int $id
     * @return string
     */
    private function setErrorMsg($id) {
        switch ($id) {
            case 1:
                $msg = 'Please provide all required informations!';
                break;
            case 2:
                $msg = 'Username or Email Adress already exists! Please choose another one.';
                break;
            case 3:
                $msg = 'Flat Code not valid!';
                break;
            default:
                $msg = 'An Error occured!';
                break;
        }

        return $msg;
    }

}
