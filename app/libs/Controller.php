<?php

/**
 * 
 */
class Controller {

    protected $model;
    protected $view;

    function __construct() {
        $this->view = new View();
        Session::init(); //Session initialisieren
        Cookie::checkCookieLogin(); //Prüfen ob Cookie Login OK
    }

    /**
     * Lädt ein Model und instanziert es anschliessend
     * @param string $model
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
     * Bindet eine Model Klasse ein
     * @param string $model
     */
    public function requireModel($model) {
        $file = ROOT . '/app/models/' . $model . 'Model.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }

    /**
     * Leitet Anfrage per Header Änderung um
     * @param string $controller
     * @param string $method
     * @param array $args
     */
    public function redirect($controller="home", $method = "index", $args = array()) {

        $location = URL . "/" . $controller . "/" . $method . "/" . implode("/", $args);
        header("Location: " . $location);
        exit;
    }

}
