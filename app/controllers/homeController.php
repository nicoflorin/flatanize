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
        $this->view->render('header');
        $this->view->render('home/index');
        $this->view->render('footer');
    }

    /**
     * Lädt SignUp Seite
     */
    public function signUp() {

        $this->view->render('header');
        $this->view->render('home/signUp');
        $this->view->render('footer');
    }

    /**
     * Übergibt POST Daten an RegisterModel
     */
    public function register() {
        $this->loadModel('Register');
        $this->model->register($_POST);
    }

}
