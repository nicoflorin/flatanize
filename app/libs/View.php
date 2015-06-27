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
    public function render($name, $data = null) {
        require (ROOT . '/app/views/header.php');
        require (ROOT . '/app/views/' . $name . '.php');
        require (ROOT . '/app/views/footer.php');
    }
}