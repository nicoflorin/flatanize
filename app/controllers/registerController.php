<?php

/**
 * Controller für die Registrierfunktionen
 *
 * @author Nico
 */
class RegisterController extends Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Übergibt POST Daten an RegisterModel
     */
    public function run() {
        //input sent from post
        $in_userName = $_POST['username'];
        $in_displayName = $_POST['displayname'];
        $in_email = $_POST['email'];
        $in_password = $_POST['password'];
        $in_flatCode = $_POST['flat_code'];

        $this->loadModel('register');
        $res = $this->model->register($in_userName, $in_displayName, $in_email, $in_password, $in_flatCode);

        //@Todo Passwortlänge mind. 8 Zeichen lang.
        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->redirect(); //home
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error', 'true');
            $this->view->render('home/signUp', 'Sign Up', $res);
        }
    }

}
