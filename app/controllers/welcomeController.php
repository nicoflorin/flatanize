<?php

/**
 * Controller für Welcome Seite
 *
 * @author Nico
 */
class WelcomeController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin();
    }

    /**
     * Lädt Welcome Index Seite
     */
    public function index() {
        //Wenn flatId Session var gesetzt, Whiteboard anzeigen
        if (Session::getFlatId()) {
            $this->redirect('whiteboard', 'index');
        } else {
            $this->view->render('app/index', 'Welcome');
        }
    }

}
