<?php

/**
 * Description of appController
 *
 * @author Nico
 */
class appController extends Controller {
    
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

    /**
     * Lädt Shopping Seite
     */
    public function shopping() {
        $this->view->render('app/shopping', 'Shopping List');
    }

    /**
     * Lädt Settings Seite
     */
    public function settings() {
        $this->view->render('app/settings', 'Settings');
    }

    /**
     * Handelt den WG Erstellungsprozess
     */
    public function createFlat() {
        $flatName = $_POST['flatName'];
        $userId = Session::get('user_id');
        $this->loadModel('flat');
        $res = $this->model->create($flatName, $userId);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->view->render('app/settings', 'Settings');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error_create', 'true');
            $this->view->render('app/settings', 'Settings', $res);
        }
    }

    /**
     * Handelt den WG Verlassenprozess
     */
    public function leaveFlat() {
        $userId = Session::get('user_id');
        $this->loadModel('flat');
        $res = $this->model->leave($userId);
        
        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->view->render('app/settings', 'Settings');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->render('app/settings', 'Settings');
        }
    }
    
    /**
     * Handelt das hinzügen eines Artikel zur Shopping List
     */
    public function addToShoppingList() {
        
    }

}
