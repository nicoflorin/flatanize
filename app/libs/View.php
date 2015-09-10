<?php

/**
 * View Parent-Klasse
 * 
 * @author Nico
 */
class View {

    //Property für View Daten
    protected $data = [];

    function __construct() {
        $this->data['title'] = 'Home';
    }

    /**
     * Lädt das entsprechende view file (html content)
     * @param string $name
     * @param string $title default ''
     * @param array $data
     */
    public function render($name, $title = '', $data = []) {
        $this->assign('title', $title);
        $this->data = array_merge($this->data, $data); // Array zu Property hinzufügen
        //HTML-Files includen / Seite rendern
        require (ROOT . '/app/views/header.php');
        require (ROOT . '/app/views/' . $name . '.php');
        require (ROOT . '/app/views/footer.php');
    }

    /**
     * Fügt ein Element dem Property data hinzu
     * @param string $key
     * @param string $value
     */
    public function assign($key, $value) {
        $this->data[$key] = $value;
    }

}
