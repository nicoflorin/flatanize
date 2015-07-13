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
        $this->loadModel('finance');
        $flatId = Session::getFlatId();

        //Hole alle Einträge aus DB
        $financeList = $this->model->getFinanceList($flatId);

        //Berechne Preis pro Person
        //Formatiere Datum um
        //Hole alle Users pro Eintrag
        $users = array();
        for ($i = 0; $i < count($financeList); $i++) {
            $financeList[$i]['pricePP'] = round($financeList[$i]['price'] / $financeList[$i]['user_count'], 2);
            $financeList[$i]['date'] = Functions::formatDate($financeList[$i]['date'], 'd.m.Y');

            //Hole alle Users
            $users[] = $this->model->getUsersOfFinanceEntry($financeList[$i]['id']);
        }

        $userBalance = $this->calcBalanceInfos();

        //übergebe Daten an View
        $this->view->userBalance = $userBalance;
        $this->view->userList = $users;
        $this->view->financeList = $financeList;
        $this->view->render('finance/index', 'Finances');
    }

    /**
     * Berechnet Balance Informationen
     */
    public function calcBalanceInfos() {
        $flatId = Session::getFlatId();
        //Alle Benutzer einer WG suchen
        $this->loadModel('flat');
        $usersBalance = $this->model->getFlatUsers($flatId);

        $this->loadModel('finance');

        //Berechne Differenz von Total Bezahlt - SOLL bezahlt pro User
        foreach ($usersBalance as $key => $user) {
            $userId = $user['id'];
            $usersBalance[$key]['sum'] = $this->model->getSumOfUser($flatId, $userId);
            $usersBalance[$key]['total'] = $this->model->getTotalOfUser($flatId, $userId);
            $usersBalance[$key]['diff'] = round($usersBalance[$key]['sum'] - $usersBalance[$key]['total'],2);
        }

        return $usersBalance;
    }

    /**
     * Lädt die Seite um einen Eintrag zu erstellen
     */
    public function showCreateEntry(...$error) {
        //Hole Displayname für alle User einer WG
        $this->loadModel('user');
        $userNames = $this->model->getAllDisplayNames(Session::getFlatId());

        //userliste an View übergeben
        $this->view->userList = $userNames;

        //Prüfen ob Fehler übermittelt
        foreach ($error as $value) {
            switch ($value) {
                case 'users':
                    $this->view->assign('users', true);
                    break;
                case 'date':
                    $this->view->assign('date', true);
                    break;
                case 'price':
                    $this->view->assign('price', true);
                    break;
            }
        }
        //Seite laden
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
        $userId = Session::get('user_id');

        $this->loadModel('finance');

        $error = [];
        //Prüfe ob Datum format 
        if (Functions::validateDate($date)) { //Y-m-d
        } else if (Functions::validateDate($date, 'd.m.Y')) {
            $date = Functions::formatDate($date); //formatiere Datum in Format y-m-d
        } else { //Kein Datum im gewünschten Format
            $error[] = 'date';
        }

        //Wenn keine Users 
        if (empty($users)) {
            $error[] = 'users';
        }

        //Prüfe ob Preis decimal zahl oder integer
        if (!is_numeric($price)) {
            $error[] = 'price';
        }

        //
        $pricePP = $price / count($users);

        //Wenn keine Fehler auftraten
        if (empty($error)) {
            //Erstelle Eintrag
            $res = $this->model->create($flatId, $userId, $product, $price, $date, $users, $pricePP);

            if ($res === true) {
                $this->redirect('finance', 'index');
            } else {
                $this->redirect('finance', 'showCreateEntry');
            }
        } else {// Sonst seite nochmals laden
            $this->redirect('finance', 'showCreateEntry', $error);
        }
    }

}
