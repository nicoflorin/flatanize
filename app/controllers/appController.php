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
        $this->view->render('app/index' , 'Home');
    }
    
    /**
     * Lädt Shopping Seite
     */
    public function shopping () {
        $this->view->render('app/shopping', 'Shopping List');
    }
}
