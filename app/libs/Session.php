<?php

/**
 * Beinhaltet die Statischen Funktionen für Session-Aufgaben
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

    /**
     * Setzt wert einer Session Variable
     * @param string $key
     * @param string $value
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Holt Wert einer Session Variable
     * @param string $key
     * @return string/boolean
     */
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Zerstört eine Session, Löscht Cookie
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
        //Wenn angemeldet
        if (Session::isLoggedIn()) {
            // Prüfen ob FlatId Session var noch aktuell
            // dann Session var FlatId mit Wert aus DB überschreiben
            // sonst Session var FlatId löschen
            $userId = Session::getUserId();
            $db = new Database();

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
        } else { //Wenn nicht angemeldet
            //Session löschen und auf Startseite weiterleiten
            Session::destroy();
            header("Location: " . URL);
            exit;
        }
    }

    /**
     * Setzt 'user_id' Session Variable
     * @param string $userId
     */
    public static function setUserId($userId) {
        $_SESSION['user_id'] = $userId;
    }

    /**
     * Gibt user ID zurück, falls vorhanden
     * @return string/boolean
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
     * @param string $flatId
     */
    public static function setFlatId($flatId) {
        $_SESSION['flat_id'] = $flatId;
    }

    /**
     * Gibt flat ID zurück, falls vorhanden
     * @return string/boolean
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
