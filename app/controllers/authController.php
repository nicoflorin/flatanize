<?php

/**
 * Controller für die Authentifizierung
 *
 * @author Nico
 */
class AuthController extends Controller{

    /**
     * Übergibt POST Daten an LoginModel
     */
    public function login() {
        $this->loadModel('login');
        $res = $this->model->login($_POST);
        if ($res === true) {
            // Setze loggedIn Session var
            Session::setLoggedIn();
            
            //Redirect zu Secure Bereich
            $this->redirect('app', 'index');
        } else {
            $this->redirect(); //home
        }
    }
    
    /**
     * Loggt einen User aus
     */
    public function logout() {
        Session::destroy();
        $this->redirect(); //home
    }

}
