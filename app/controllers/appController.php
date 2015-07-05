<?php

/**
 * Description of appController
 *
 * @author Nico
 */
class appController extends Controller {

    /**
     * Lädt Secure Index Seite
     */
    public function index() {
        $this->view->render('app/index', 'Home');
    }

    /**
     * Lädt Shopping Seite
     */
    public function shopping() {
        $this->view->render('app/shopping', 'Shopping List');
    }

    /**
     * Lädt Settings Seite
     */
    public function settings() {
        $this->view->render('app/settings', 'Settings');
    }

    /**
     * 
     */
    public function createFlat() {
        $this->loadModel('flat');
        $res = $this->model->create($_POST);
        
        //Falls keine Fehler aufgetreten sind
        if ($res === true) {
            echo 'success';
            print_r($_SESSION);

        } else { // Sonst Formular nochmals laden, mit Error Daten
            $this->view->assign('error', 'true');
            $this->view->render('app/settings', 'Settings', $res);
        }
    }

}
