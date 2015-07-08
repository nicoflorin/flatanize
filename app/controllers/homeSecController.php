<?php

/**
 * Zuständig für Secure Home
 *
 * @author Nico
 */
class HomeSecController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin();
    }

    /**
     * Lädt Secure Index Seite
     */
    public function index() {
        $this->view->render('app/index', 'Home');
    }

}
