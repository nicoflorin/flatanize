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
        $flatId = Session::get('flat_id');
        $this->loadModel('shopping');
        $list = $this->model->getList($flatId);
        $this->view->list = $list;
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
        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $flatId = Session::get('flat_id');
        
        $error = [];
        if (empty($product)) {
            $error['product'] = true;
            $error['error_id'] = 'Please Enter a Product name!';
        }
        
        $this->loadModel('shopping');
        $res = $this->model->add($flatId, $product, $amount);
        $this->redirect('app/shopping');
    }
    
    /*
     * Handelt das Löschen eines Shopping List Eintrages
     */
    public function deleteFromShoppingList($id) {
        $this->loadModel('shopping');
        $res = $this->model->delete($id);
        $this->redirect('app/shopping');
    }

}
