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

}
