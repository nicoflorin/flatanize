<?php

/**
 * Description of registerController
 *
 * @author Nico
 */
class registerController extends Controller{

    function __construct() {
        parent::__construct();
    }

    /**
     * Lädt SignUp Seite
     */
    public function signUp() {
        $this->view->render('register/signUp', 'Sign Up');
    }

    /**
     * Übergibt POST Daten an RegisterModel
     */
    public function run() {
        $this->loadModel('register');
        $res = $this->model->register($_POST);

        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            $this->redirect('home', 'index');
            //$this->view->render('home/index');
        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error', 'true');
            $this->view->render('register/signUp', 'Sign Up', $res);
        }
    }

}
