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
        //$this->inc_view('home/index', ['name' => $user->getName()]);
        $this->view->render('home/index');
    }

    /**
     * Lädt SignUp Seite
     */
    public function signUp() {
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
            $this->view->render('home/signUp', $res);
        }
    }

}
