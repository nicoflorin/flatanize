<?php

/**
 * Controller für Finanzen
 *
 * @author Nico
 */
class financeController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin(); //Prüft ob User eingeloggt
    }

}
