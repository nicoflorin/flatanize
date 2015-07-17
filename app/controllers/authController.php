<?php

/**
 * Controller für die Authentifizierung
 *
 * @author Nico
 */
class AuthController extends Controller {

    /**
     * Übergibt POST Daten an LoginModel
     */
    public function login() {

        //POST Daten aus Formular
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];
        
        $remember = (isset($remember) && $remember === 'on') ? true : false;

        //Lade login model
        $this->loadModel('login');
        // Übergebe Daten an Model
        $res = $this->model->login($username, $password, $remember);
        
        //Falls Login erfolgreich
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
