<?php

/**
 * View Hauptklasse
 */
class View {

    function __construct() {

    }
    
    /**
     * Lädt das entsprechende view file (html content)
     * @param type $name
     */
    public function render($name) {
        require (ROOT . '/app/views/' . $name . '.php');
    }
}