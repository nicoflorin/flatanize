<?php

class Controller {

    function __construct() {
        echo 'Main Controller <br />';
        $this->view = new View();
    }
    
    /**
     * Lädt ein Model und instanziert es anschliessend
     * @param type $model
     */
    public function loadModel($model) {
        
        $file = '../app/models/' . $model . '.php';
        
        if (file_exists($file)) {
            require_once $file;
            $this->model = new $model();
        }
        
    }
    
    // Mometan nicht gebraucht
    /**
     * 
     * @param type $view
     * @param type $data
     
    public function inc_view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
    */
}