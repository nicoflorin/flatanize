<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index ($name = '') {
        echo 'We are in home/index <br />';
        $user = $this->load_model('User');
        $user->setName($name);

        //$this->inc_view('home/index', ['name' => $user->getName()]);
        
        $this->view->render('header');
        $this->view->render('home/index');
        $this->view->render('footer');
    }

}
