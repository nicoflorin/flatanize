<?php

/**
 * Controller für Home
 */
class HomeController extends Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Lädt index Seite
     */
    public function index($name = '') {
        $this->view->render('home/index', 'Home');
    }
    
    /**
     * Übergibt POST Daten an LoginModel
     */
    public function login() {
        $this->loadModel('login');
        $res = $this->model->login($_POST);
        if ($res === TRUE) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
