<?php

/**
 * Description of appController
 *
 * @author Nico
 */
class SettingsController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin();
    }

    /**
     * Lädt settings index Seite
     */
    public function index() {
        $flatId = Session::getFlatId();
        //Falls Session var gesetzt, hole WG Code aus DB
        if ($flatId !== false) {
            $this->loadModel('flat');
            // Übergebe Daten an View
            $this->view->flatName = $this->model->getFlatName($flatId);
            $this->view->flatCode = $this->model->getFlatCode($flatId);
        }
        $this->view->render('settings/index', 'Settings');
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
            $this->redirect('settings', 'index');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error_create', true);
            $this->view->render('settings/index', 'Settings', $res);
        }
    }

    /**
     * Handelt den WG Verlassenprozess
     */
    public function leaveFlat() {
        $userId = Session::get('user_id');
        $this->loadModel('flat');
        $res = $this->model->leave($userId);

        $this->redirect('settings', 'index');
    }

    /**
     * Handelt den Prozess um einer bestehenden WG beizutreten
     */
    public function joinFlat() {
        $userId = Session::get('user_id');
        $flatCode = $_POST['flatCode'];

        $this->loadModel('flat');
        $res = $this->model->join($userId, $flatCode);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->redirect('settings', 'index');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error_join', true);
            $this->view->render('settings/index', 'Settings', $res);
        }
    }

    /**
     * Handelt das versenden des WG Code
     */
    public function shareFlat() {
        $email = $_POST['email'];
        $this->loadModel('flat');
        $flatCode = $this->model->getFlatCode(Session::getFlatId());

        //@Todo Email versand
        $betreff = 'Der Betreff';
        $nachricht = $flatCode;
        $header = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        mail($email, $betreff, $nachricht, $header);

        $this->redirect('settings', 'index');
    }

}
