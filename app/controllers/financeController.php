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

        //user Liste initialisieren
        $users = array();

        //Loop durch alle Finanz Einträge
        for ($i = 0; $i < count($financeList); $i++) {
            //Berechne Preis pro Person
            $financeList[$i]['pricePP'] = round($financeList[$i]['price'] / $financeList[$i]['user_count'], 2);
            //Formatiere Datum um
            $financeList[$i]['date'] = Functions::formatDate($financeList[$i]['date'], 'd.m.Y');
            //Id des Finanz Eintrag
            $financeId = $financeList[$i]['id'];
            //Hole alle beteiligten Users pro Finanz Eintrag, schreibe in Array mit Index FinanzID
            $users[$financeId] = $this->model->getUsersOfFinanceEntry($financeId);
        }
        //Hole Alle Users einer WG
        $this->requireModel('flat');
        $flatModel = new FlatModel();
        $flatUsers = $flatModel->getFlatUsers($flatId);
        
        // Berechne Balance Informationen pro User
        $userBalance = $this->model->calcBalanceInfos($flatId, $flatUsers);

        //übergebe Daten an View
        $this->view->userBalance = $userBalance;
        $this->view->userList = $users;
        $this->view->financeList = $financeList;
        $this->view->render('finance/index', 'Finances');
    }

    /**
     * Rechnet die Balance ab
     */
    public function clearBalance() {
        $this->loadModel('finance');
        $flatId = Session::getFlatId();
        $this->model->clearBalance($flatId);

        $this->redirect('finance', 'index');
    }

    /**
     * Lädt die Seite um einen Eintrag zu erstellen
     * 
     * @param array $error
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
                case 'product':
                    $this->view->assign('product', true);
                    break;
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
        $product = strip_tags($_POST['product']);
        $price = $_POST['price'];
        $date = $_POST['date'];
        $users = (isset($_POST['user'])) ? $_POST['user'] : ''; //Array, falls nicht gesetzt leer lassen
        $flatId = Session::getFlatId();
        $userId = Session::getUserId();

        //Errorhandling
        $error = [];
        
        //Prüfe ob Product eingegeben
        if (empty($product)) {
            $error[] = 'product';
        } 
        
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
        //oder ob grösser als 0
        if (!is_numeric($price) || $price <= 0) {
            $error[] = 'price';
        }

        //Preis Pro Person berechnen
        $pricePP = $price / count($users);

        //Wenn keine Fehler auftraten
        if (empty($error)) {
            //Erstelle Eintrag
            $this->loadModel('finance');
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

    /**
     * Löscht einen Eintrag aus der DB
     */
    public function deleteEntry() {
        $id = $_POST['id'];
        if (!empty($id)) {
            $this->loadModel('finance');
            $this->model->deleteEntry($id);
        }

        $this->redirect('finance', 'index');
    }

}
