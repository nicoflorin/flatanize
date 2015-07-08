<?php
/**
 * Ist Zuständig für die Shopping Funktionen
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
        $flatId = Session::getFlatId();
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
        $flatId = Session::getFlatId();

        //Falls kein Produkt eingegeben wurde
        //@Todo Fehlermeldung anzeigen, wenn nichts eingegeben wurde
        if (empty($product)) {
            $this->redirect('shopping', 'index');
        } else {
            $this->loadModel('shopping');
            $res = $this->model->add($flatId, $product, $amount);
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
