<?php

/**
 * Ist zuständig für die Registrierfunktionen
 *
 * @author Nico
 */
class registerController extends Controller{

    function __construct() {
        parent::__construct();
    }

    /**
     * Übergibt POST Daten an RegisterModel
     */
    public function run() {
        $this->loadModel('register');
        $res = $this->model->register($_POST);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->redirect();//home

        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error', 'true');
            $this->view->render('home/signUp', 'Sign Up', $res);
        }
    }

}
