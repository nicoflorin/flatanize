<?php

/**
 * View Hauptklasse
 */
class View {

    protected $data = [];

    function __construct() {
        $this->data['title'] = 'Home';
    }

    /**
     * Lädt das entsprechende view file (html content)
     * @param type $name
     * @param type $data
     */
    public function render($name, $data = []) {
        $this->data = array_merge($this->data, $data); // Array zu Property hinzufügen
        require (ROOT . '/app/views/header.php');
        require (ROOT . '/app/views/' . $name . '.php');
        require (ROOT . '/app/views/footer.php');
    }
    
    /**
     * Fügt ein Element dem Property data hinzu
     * @param type $name
     * @param type $value
     */
    public function assign($key, $value) {
         $this->data[$key] = $value;
    }

}
