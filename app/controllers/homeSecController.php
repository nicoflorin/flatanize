<?php

/**
 * Controller für Secure Home
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
        $this->loadModel('user');
        $this->view->displayName = $this->model->getDisplayName(Session::get('user_id'));
        $this->view->render('app/index', 'Home');
    }

}
