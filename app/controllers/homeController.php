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
    public function index() {
        if (Session::isLoggedIn()) {
            $this->view->render('app/index', 'Home');
        } else {
            $this->view->render('home/index', 'Home');
        }
    }

    /**
     * Lädt faq Seite
     */
    public function faq() {
        $this->view->render('home/faq', 'FAQ');
    }

    /**
     * Lädt About Seite
     */
    public function about() {
        $this->view->render('home/about', 'About');
    }

    /**
     * Lädt SignUp Seite
     */
    public function signUp() {
        $this->view->render('home/signUp', 'Sign Up');
    }

}
