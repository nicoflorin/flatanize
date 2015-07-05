<?php

/**
 * Description of Auth
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
        if ($res === TRUE) {
            //Set logged In Session key
            Session::set('loggedIn', true);
            
            $this->redirect('app', 'shopping');
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
