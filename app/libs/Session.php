<?php

/**
 * Description of Session
 *
 * @author Nico
 */
class Session {

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

    public static function destroy() {
        unset($_SESSION);
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

}
