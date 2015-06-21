<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($name = '') {
        echo 'We are in error/index <br />';
        $this->inc_view('error/index');
    }

}
