<?php

/**
 * Description of Session
 *
 * @author Nico
 */
class Session {

    /**
     * Startet eine Session
     */
    public static function init() {
        @session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Zerstört eine Session
     */
    public static function destroy() {
        unset($_SESSION);
        Cookie::delete('token');
        session_destroy();
    }

    /**
     * Prüft ob die Session Variable 'loggedIn' gesetzt ist
     * @return boolean
     */
    public static function isLoggedIn() {
        if (isset($_SESSION['loggedIn'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Setzt 'loggedIn' Session Variable
     */
    public static function setLoggedIn() {
        $_SESSION['loggedIn'] = true;
    }

    /**
     * Prüft ob der Benutzer eingeloggt ist. Sonst zurück zum Start
     * @return boolean
     */
    public static function checkLogin() {
        if (Session::isLoggedIn()) {
            $userId = Session::getUserId();
            $db = new Database();
            // Session var FlatId mit Wert aus DB überschreiben
            // Select auf diesen user
            
            $bind = array(':userId' => $userId);
            $res = $db->select('flats_id', 'users', 'id = :userId LIMIT 1', $bind);
            $flatId = $res[0]['flats_id'];
            
            //Prüfen ob flatId in DB leer
            if (!empty($flatId)) {
                Session::setFlatId($flatId); //flatId Session var überschreiben
            } else {
                Session::unSetFlatId(); //flatId Session var löschen
            }
            
            return true;
        } else {
            Session::destroy();
            header("Location: " . URL);
            exit;
        }
    }

    /**
     * Setzt 'user_id' Session Variable
     */
    public static function setUserId($userId) {
        $_SESSION['user_id'] = $userId;
    }

    /**
     * Gibt user ID zurück, falls vorhanden
     * @return boolean
     */
    public static function getUserId() {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        } else {
            return false;
        }
    }

    /**
     * Setzt 'flat_id' Session Variable
     */
    public static function setFlatId($flatId) {
        $_SESSION['flat_id'] = $flatId;
    }

    /**
     * Gibt flat ID zurück, falls vorhanden
     * @return boolean
     */
    public static function getFlatId() {
        if (isset($_SESSION['flat_id'])) {
            return $_SESSION['flat_id'];
        } else {
            return false;
        }
    }

    /**
     * Löscht flat_id Session var
     */
    public static function unSetFlatId() {
        unset($_SESSION['flat_id']);
    }

}
