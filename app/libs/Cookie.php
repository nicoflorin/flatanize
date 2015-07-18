<?php

/**
 * Description of Cookie
 *
 * @author Nico
 */
class Cookie {

    /**
     * Prüft ob ein Cookie existiert
     * @param type $key
     * @return boolean
     */
    public static function exists($key) {
        if (isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Holt ein Cookie anhand des keys
     * @param type $key
     * @return boolean
     */
    public static function get($key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return false;
        }
    }

    /**
     * Setzt ein Cookie mit key, wert und expire time
     * @param type $key
     * @param type $value
     * @param type $expire
     * @return boolean
     */
    public static function set($key, $value, $expire) {
        if (setcookie($key, $value, time() + $expire, '/')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Löscht ein Cookie indem die Expire Time in die Vergangenheit gesetzt wird
     * @param type $key
     * @return boolean
     */
    public static function delete($key) {
        if (Cookie::set($key, '', time() - 1)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Prüft, ob Cookie vorhanden und gültig. Meldet User an falls OK
     */
    public static function checkCookieLogin() {
        //Falls token cookie vorhanden und session noch nicht gestartet
        if (Cookie::exists('token') && !Session::isLoggedIn()) {
            $token = Cookie::get('token');
            $db = new Database();

            // Select auf diesen token
            $bind = array(':token' => $token);
            $res = $db->select('id, flats_id', 'users', 'token = :token LIMIT 1', $bind);

            //Falls ein Eintrag gefunden wurde
            if (!empty($res)) {
                $flatId = $res[0]['flats_id'];
                $userId = $res[0]['id'];

                //Schreibe User Session var
                Session::setUserId($userId);

                //Schreibe flat Session var
                if (isset($flatId)) {
                    Session::setFlatId($flatId);
                }

                //Schreibe LoggedIn Session var
                Session::setLoggedIn();
            } 
        }
    }

}
