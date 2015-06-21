<?php

class Controller {

    function __construct() {
        echo 'Main Controller <br />';
        //$this->view = new View();
    }
    
    /**
     * 
     * @param type $model
     * @return \model
     */
    public function create_model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    
    /**
     * 
     * @param type $view
     * @param type $data
     */
    public function inc_view($view, $data = []) {
        require_once '../app/views/header.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/footer.php';
    }

}