<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
        echo 'We are in Error <br />';
        
        $this->view->render('error/index');
    }

}