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
     */
    public static function formatDate($date, $format = 'Y-m-d') {
        $out = new DateTime($date);
        return $out->format($format);
    }

    /**
     * Erstellt einen zufälligen String
     * @param type $length
     * @return type
     */
    public static function generateRandomData($length = 64) {
        return openssl_random_pseudo_bytes($length);
    }

    /**
     * Erstellt einen Hash wert
     * @param type $string
     * @return type
     */
    public static function hash($string) {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * Return True falls das Password mit dem Sal und Hash übereinstimmt
     */
    public static function testPassword($password, $saltFromDB, $hashFromDB) {
        //old (hash_hmac("sha256", $password, $saltFromDB) == $hashFromDB) {
        if (password_verify($password . $saltFromDB, $hashFromDB)) { // Standard PHP hashing Function benutzt
            return true;
        } else {
            return false;
        }
    }

}
