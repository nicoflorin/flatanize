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
     * Lädt SignUp Seite
     */
    public function index() {
        $this->view->render('home/signUp', 'Sign Up');
    }

    /**
     * Übergibt POST Daten an RegisterModel
     */
    public function run() {
        //input sent from post
        $in_userName = strip_tags($_POST['username']);
        $in_displayName = strip_tags($_POST['displayname']);
        $in_email = strip_tags($_POST['email']);
        $in_password = $_POST['password'];
        $in_flatCode = $_POST['flat_code'];
        
        //@Todo Fehlerüberprüfung 

        $this->loadModel('settings');
        $res = $this->model->register($in_userName, $in_displayName, $in_email, $in_password, $in_flatCode);

        //@Todo Passwortlänge mind. 8 Zeichen lang.
        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->view->assign('success', 'true');
            $this->view->render('home/signUp', 'Sign Up');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error', 'true');
            $this->view->render('home/signUp', 'Sign Up', $res);
        }
    }

}
