<?php

/**
 * 
 */
class Controller {

    protected $model;
    protected $view;

    function __construct() {
        $this->view = new View();
        Session::init();
    }

    /**
     * Lädt ein Model und instanziert es anschliessend
     * @param type $model
     */
    public function loadModel($model) {

        $file = ROOT . '/app/models/' . $model . 'Model.php';

        if (file_exists($file)) {
            require_once $file;
            $this->model = $model . "Model";
            $this->model = new $this->model();
        }
    }

    /**
     * Leitet Anfrage per Header Änderung um
     */
    public function redirect($controller="home", $method = "index", $args = array()) {

        $location = URL . "/" . $controller . "/" . $method . "/" . implode("/", $args);
        header("Location: " . $location);
        exit;
    }

}
