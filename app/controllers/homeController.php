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
        //Prüfung ob User eingeloggt ist. Je nachdem secure oder non-secure Bereich anzeigen
        if (Session::isLoggedIn()) {
            $this->redirect('whiteboard', 'index');
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

}
