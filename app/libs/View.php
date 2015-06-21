<?php
// weiss noch nicht wofür ich die brauch
class View {

    function __construct() {
        echo 'This is the View <br />';
    }

    public function render($name) {
        require 'views/header.php';
        require 'views/' . $name . '.php';
        require 'views/footer.php';
    }
}