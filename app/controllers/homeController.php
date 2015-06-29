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
        $this->view->render('home/index');
    }

    /**
     * Lädt SignUp Seite
     */
    public function signUp() {
        $this->view->assign('title', 'Sign Up');
        $this->view->render('home/signUp');
    }

    /**
     * Übergibt POST Daten an RegisterModel
     */
    public function register() {
        $this->loadModel('register');
        $res = $this->model->register($_POST);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->view->render('home/index');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('title', 'Sign Up');
            $this->view->assign('error', 'true');
            $this->view->render('home/signUp', $res);
        }
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
