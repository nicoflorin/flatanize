<?php

/**
 * Controller für Finanzen
 *
 * @author Nico
 */
class FinanceController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin(); //Prüft ob User eingeloggt
    }

    /**
     * Lädt index Seite
     */
    public function index() {
        $this->view->render('finance/index', 'Finances');
    }

    /**
     * Lädt die Seite um einen Eintrag zu erstellen
     */
    public function showCreateEntry($error = '') {
        //Hole Displayname für alle User einer WG
        $this->loadModel('user');
        $userNames = $this->model->getAllDisplayNames(Session::getFlatId());

        //userliste an View übergeben
        $this->view->userList = $userNames;

        //Prüfen ob Fehler übermittelt
        switch ($error) {
            case 'users':
                $this->view->assign('users', true);
                break;
            case 'date':
                $this->view->assign('date', true);
                break;
        }

        $this->view->render('finance/create_entry', 'Finances');
    }

    /**
     * Erstellt einen neuen Finanz Eintrag
     */
    public function createEntry() {
        $product = $_POST['product'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $users = (isset($_POST['user'])) ? $_POST['user'] : ''; //Array, falls nicht gesetzt leer lassen
        $flatId = Session::getFlatId();

        $this->loadModel('finance');

        $error = [];
        //Prüfe ob Datum format 
        if (Functions::validateDate($date)) { //Y-m-d
        } else if (Functions::validateDate($date, 'd.m.Y')) {
            $date = Functions::formatDate($date); //formatiere Datum in Format y-m-d
        } else { //Kein Datum im gewünschten Format
            $error['date'] = 'date';
        }

        //Wenn keine Users 
        if (empty($users)) {
            $error['users'] = 'users';
            exit;
        }

        //Wenn keine Fehler auftraten
        if (empty($error)) {

            $res = $this->model->create($flatId, $product, $price, $date, $users);

            if ($res === true) {
                $this->redirect('finance', 'index');
            } else {
                $this->redirect('finance', 'showCreateEntry');
            }
        } else {
            $this->redirect('finance', 'showCreateEntry', $error);
        }
    }

}
