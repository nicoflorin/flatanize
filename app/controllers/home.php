<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index ($name = '') {
        echo 'We are in home/index <br />';
        $this->loadModel('User');
        $this->model->setName($name);

        //$this->inc_view('home/index', ['name' => $user->getName()]);
        
        $this->view->render('header');
        $this->view->render('home/index');
        $this->view->render('footer');
    }

}
