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
        if (Session::isLoggedIn()) {
            $this->view->render('app/index', 'Home');
        } else {
            $this->view->render('home/index', 'Home');
        }
        
    }
    

}