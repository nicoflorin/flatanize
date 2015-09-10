<?php

/**
 * Allgemeine Sammlung von nützlichen Funktionen
 *
 * @author Nico
 */
class Functions {

    /**
     * Prüft einen String auf das korrekte Datum Format
     * @param string $date
     * @param string $format
     * @return boolean
     */
    public static function validateDate($date, $format = 'Y-m-d') {
        try {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Formatiert ein DateTime in das gewünschte Format
     * @param DateTime $date
     * @param string $format
     * @return string
     */
    public static function formatDate($date, $format = 'Y-m-d') {
        $out = new DateTime($date);
        return $out->format($format);
    }

    /**
     * Erstellt einen zufälligen String
     * @param string $length
     * @return string
     */
    public static function generateRandomData($length = 64) {
        return bin2hex(openssl_random_pseudo_bytes($length / 2)); //Länge halbieren da bin2hex aus 1 byte 2 byte macht
    }

    /**
     * Erstellt einen Hash wert
     * @param string $string
     * @return string
     */
    public static function hash($string) {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * Return True falls das String mit dem Salt und Hash übereinstimmt
     * @param string $string
     * @param string $salt
     * @param string $hash
     * @return boolean
     */
    public static function testHash($string, $salt, $hash) {
        if (password_verify($string . $salt, $hash)) { // Standard PHP hashing Function benutzt
            return true;
        } else {
            return false;
        }
    }

    /**
     * Erstellt einen zufälligen String
     * @param int $length
     * @return string
     */
    public static function createRandomCode($length) {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[mt_rand(0, 61)];
        }
        return $result;
    }

}
