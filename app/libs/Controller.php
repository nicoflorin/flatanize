<?php

/**
 * 
 */
class Controller {

    protected $model;
    protected $view;

    function __construct() {
        $this->view = new View();
    }

    /**
     * Lädt ein Model und instanziert es anschliessend
     * @param type $model
     */
    public function loadModel($model) {

        $file = ROOT . '/app/models/' . $model . 'Model.php';

        if (file_exists($file)) {
            require_once $file;
            $this->model = new $model();
        }
    }

    /**
     * Leitet Anfrage per Header Änderung um
     */
    public function redirect($controller, $method = "index", $args = array()) {

        $location = URL . "/" . $controller . "/" . $method . "/" . implode("/", $args);
        header("Location: " . $location);
        exit;
    }
}
