<?php
/**
 * Description of appController
 *
 * @author Nico
 */
class appController extends Controller {
    public function shopping () {
        if (Session::get('loggedIn')) {
            $this->view->render('app/shopping', 'Shopping List');
        } else {
            Session::destroy();
            $this->redirect(); //home
        }
        
    }
}
