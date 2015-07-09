<?php

/**
 * Ist Zuständig für die Shopping Funktionen
 *
 * @author Nico
 */
class ShoppingController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin(); //Prüft ob User eingeloggt
    }

    /**
     * Lädt Shopping index Seite
     */
    public function index() {
        $flatId = Session::getFlatId();
        $this->loadModel('shopping');
        $list = $this->model->getList($flatId);
        $this->view->list = $list;
        $this->view->render('shopping/index', 'Shopping List');
    }

    /**
     * Handelt das hinzügen eines Artikel zur Shopping List
     */
    public function addToShoppingList() {
        //@Todo Eingabe Produkt mit Produkt:Menge. Dann String bei : trennen
        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $flatId = Session::getFlatId();
        $userId = Session::get('user_id');

        //Falls kein Produkt eingegeben wurde
        //@Todo Fehlermeldung anzeigen, wenn nichts eingegeben wurde
        if (!empty($product)) {
            //Menge default 1
            if (empty($amount)) {
                $amount = 1;
            }
            $this->loadModel('shopping');
            $res = $this->model->add($flatId, $product, $amount, $userId);
            $this->redirect('shopping', 'index');
        } else {
            $this->redirect('shopping', 'index');
        }
    }

    /*
     * Handelt das Löschen eines Shopping List Eintrages
     */

    public function deleteFromShoppingList($id) {
        //@Todo prüfen ob user berechtigt ist zum löschen
        $this->loadModel('shopping');
        $res = $this->model->delete($id);
        $this->redirect('shopping', 'index');
    }

}
