<?php

/**
 * Verarbeitet die Registrierung eines Benutzers
 * 
 * @author Nico
 */
class SettingsModel extends Model {
    const MAX_DISPLAYNAME = 15;

    function __construct() {
        parent::__construct();
    }
    
    /**
     * Ändert den Anzeigenamen für ein Benutzer
     * @param string $displayName
     * @param int $userId
     * @return boolean/string
     */
    public function changeDisplayName($displayName, $userId) {
        $error = '';
        
        //Prüfen ob Eingabe gemacht
        if (empty($displayName)) {
            $error = $this->setErrorMsg(6); //no value entered
        }

        // Prüfen ob DisplayName maxLen nicht überschreitet
        if (strlen($displayName) > self::MAX_DISPLAYNAME) {
            $error = $this->setErrorMsg(7);
        }
        
        //Falls kein Fehler auftrat
        if (empty($error)) {
            $bind = array(
                ':userId' => $userId,
                ':displayName' => $displayName
            );
            //Setze neuen Namen
            $res = $this->db->update('users', 'display_name = :displayName', 'id = :userId', $bind);
            
            if ($res > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return $error;
        }
    }

    /**
     * Ändert das Paswort für einen Benutzer
     * @param string $oldPW
     * @param string $newPW
     * @param string $verPW
     * @param int $userId
     * @return boolean/string
     */
    public function changePassword($oldPW, $newPW, $verPW, $userId) {
        $error = '';
        //Prüfen ob beide PWs gleich
        if ($newPW !== $verPW) {
            $error = $this->setErrorMsg(5);
            return $error;
        }
        
        //Vergleiche eingegebenes altes Passwort mit Passwort von DB
        $bind = array(':userId' => $userId);
        $res = $this->db->select('password, salt', 'users', 'id = :userId LIMIT 1', $bind);
        $saltFromDB = $res[0]['salt'];
        $pwFromDB = $res[0]['password'];

        if (Functions::testHash($oldPW, $saltFromDB, $pwFromDB)) {
            //Setze neues Passwort
            $salt = Functions::generateRandomData(64); //Generiere Random String
            $string = $newPW . $salt;
            $hashed_password = Functions::hash($string); //Standard PHP Hashing function benutzt bcrypt (länge 60 zeichen)
            $bind = array(
                ':newPW' => $hashed_password,
                ':newSalt' => $salt,
                ':userId' => $userId
            );
            $res = $this->db->update('users', 'password = :newPW, salt = :newSalt', 'id = :userId', $bind);

            return true;
        } else {
            //Bei Fehler Meldung zurückgeben
            return $this->setErrorMsg(4);
        }
    }

    /**
     * Prüft Benutzer Eingaben und erstellt den User in der DB.
     * @param string $userName
     * @param string $displayName
     * @param string $email
     * @param string $password
     * @param int $flatCode
     * @return boolean/string
     */
    public function register($userName, $displayName, $email, $password, $flatCode = "") {

        $error = [];
        // Eingabe prüfen ob nicht leer
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
        
        // Prüfen ob DisplayName maxLen nicht überschreitet
        if (strlen($displayName) > self::MAX_DISPLAYNAME) {
            $error['displayname'] = true;
            $error['error_id'] = 7;
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
            $res = $this->db->select('id', 'flats', 'code = :flat_code LIMIT 1', $bind);
            if (empty($res)) {
                $error['error_id'] = 3;
            } else {
                $flatId = $res[0]['id'];
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
            if (!empty($flatCode)) {
                $error["flatCode"] = $flatCode;
            }

            // Return Error
            return $error;
        } else { // sonst User erstellen
            $salt = Functions::generateRandomData(64); //Generiere Random String
            // old $hashed_password = hash_hmac("sha256", $password, $salt); // Hashe Passwort mit Salt
            $string = $password . $salt;
            $hashed_password = Functions::hash($string); //Standard PHP Hashing function benutzt bcrypt (länge 60 zeichen)

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
            if (!empty($flatId)) {
                $user_id = $this->db->lastInsertId(); // Id des erstellen Users
                require_once ROOT . '/app/models/userModel.php';
                $user = new UserModel();
                $user->linkUserToFlat($user_id, $flatId);
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
            case 4:
                $msg = 'Old Password is not correct!';
                break;
            case 5:
                $msg = 'Passwords do not match!';
                break;
            case 6:
                $msg = 'Please enter a value!';
                break;
            case 7:
                $msg = 'Display Name too long! Max. 15 characters!';
                break;
            default:
                $msg = 'An Error occured!';
                break;
        }

        return $msg;
    }

}
