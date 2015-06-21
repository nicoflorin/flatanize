<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index ($name = '') {
        echo 'We are in home/index <br />';
        $user = $this->create_model('User');
        $user->setName($name);

        $this->inc_view('home/index', ['name' => $user->getName()]);
    }

}
