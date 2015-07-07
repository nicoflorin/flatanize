<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shoppingController
 *
 * @author Nico
 */
class shoppingController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin(); //Prüft ob User eingeloggt
    }

    /**
     * Lädt Shopping index Seite
     */
    public function index() {
        $flatId = Session::get('flat_id');
        $this->loadModel('shopping');
        $list = $this->model->getList($flatId);
        $this->view->list = $list;
        $this->view->render('app/shopping', 'Shopping List');
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
        $this->redirect('shopping/index');
    }

    /*
     * Handelt das Löschen eines Shopping List Eintrages
     */
    public function deleteFromShoppingList($id) {
        $this->loadModel('shopping');
        $res = $this->model->delete($id);
        $this->redirect('shopping/index');
    }

}
