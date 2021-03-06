<?php

/**
 * Controller für Einstellungen
 *
 * @author Nico
 */
class SettingsController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin();
    }

    /**
     * Lädt die Index Seite
     */
    public function index() {
        $this->flatSettings();
    }

    /**
     * Lädt flat settings Seite
     */
    public function flatSettings() {
        $flatId = Session::getFlatId();
        //Falls Session var gesetzt, hole WG Code aus DB
        if ($flatId !== false) {
            $this->loadModel('flat');
            // Übergebe Daten an View
            $this->view->flatName = $this->model->getFlatName($flatId);
            $this->view->flatCode = $this->model->getFlatCode($flatId);

            //Hole Usernames und übergebe an view
            $this->requireModel('user');
            $userModel = new UserModel();
            $this->view->users = $userModel->getAllUsers($flatId);
        }
        $this->view->render('settings/flatSettings', 'Flat Settings');
    }

    /**
     * Lädt user settings Seite
     */
    public function userSettings() {
        $this->view->render('settings/userSettings', 'User Settings');
    }

    /**
     * Handelt den WG Erstellungsprozess
     */
    public function createFlat() {
        $flatName = strip_tags($_POST['flatName']);
        $userId = Session::getUserId();
        $this->loadModel('flat');
        $res = $this->model->create($flatName, $userId);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->redirect('settings', 'flatSettings');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error_create', true);
            $this->view->render('settings/flatSettings', 'Flat Settings', $res);
        }
    }

    /**
     * Handelt den WG Verlassenprozess
     */
    public function leaveFlat() {
        $userId = Session::getUserId();

        $this->loadModel('flat');
        $this->model->leave($userId);

        //Session var löschen
        Session::unSetFlatId();

        $this->redirect('settings', 'flatSettings');
    }

    /**
     * Wirft einen WG Bewohner aus der WG
     */
    public function throwOut() {
        $userId = $_POST['id'];
        if (!empty($userId)) {
            if (Session::getUserId() != $userId) {
                $this->loadModel('flat');
                $this->model->leave($userId);
            }

            $this->redirect('settings', 'flatSettings');
        }
    }

    /**
     * Handelt den Prozess um einer bestehenden WG beizutreten
     */
    public function joinFlat() {
        $userId = Session::getUserId();
        $flatCode = $_POST['flatCode'];

        $this->loadModel('flat');
        $res = $this->model->join($userId, $flatCode);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->redirect('settings', 'flatSettings');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error_join', true);

            $this->view->render('settings/flatSettings', 'Flat Settings', $res);
        }
    }

    /**
     * Handelt das versenden des WG Code
     */
    public function shareFlat() {
        $email = $_POST['email'];
        $this->loadModel('flat');
        $flatCode = $this->model->getFlatCode(Session::getFlatId());

        $betreff = 'flatanize invitation';
        $nachricht = 'Hello' . "\r\n" . 'Want to join my awesome flat on flatanize?' . "\r\n" .
                'Create an account at ' . URL . '/register/index and enter this flat code: '. $flatCode;
 
        $header = 'From: webmaster@flatanize.com' . "\r\n" .
                'Reply-To: webmaster@flatanize.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        mail($email, $betreff, $nachricht, $header);

        $this->redirect('settings', 'flatSettings');
    }

    /**
     * Handelt den Passwort-Wechsel
     */
    public function changePassword() {
        $oldPW = $_POST['old_password'];
        $newPW = $_POST['new_password'];
        $verPW = $_POST['verify_password'];
        $userId = Session::getUserId();

        $this->loadModel('settings');
        $res = $this->model->changePassword($oldPW, $newPW, $verPW, $userId);
        //Falls kein Fehler auftrat
        if ($res === true) {
            $this->view->assign('success_pwchange', true);
        } else {
            $this->view->assign('error_pwchange', true);
            $this->view->assign('error_msg', $res);
        }

        $this->view->render('settings/userSettings', 'User Settings');
    }

    /**
     * Handelt das Wechseln des Anzeigenamens
     */
    public function changeDisplayName() {
        $displayName = strip_tags($_POST['displayName']);
        $userId = Session::getUserId();

        $this->loadModel('settings');
        $res = $this->model->changeDisplayName($displayName, $userId);

        //Falls kein Fehler auftrat
        if ($res === true) {
            $this->view->assign('success_dnChange', true);
        } else {
            $this->view->assign('error_msg', $res);
            $this->view->assign('error_dnChange', true);
        }

        $this->view->render('settings/userSettings', 'User Settings');
    }

}
