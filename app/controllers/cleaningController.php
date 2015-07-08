<?php

/**
 * Description of cleaningController
 *
 * @author Nico
 */
class CleaningController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin(); //Prüft ob User eingeloggt
    }

    /**
     * Lädt Cleaning index Seite
     */
    public function index() {
        $this->view->render('cleaning/index', 'Cleaning Schedules');
    }

    /**
     * Lädt Seite um neuen Task zu erstellen
     */
    public function showCreateTask() {
        $this->view->render('cleaning/create_task', 'Cleaning Schedules');
    }
    
    public function createTask() {
        $title = $_POST['title'];
        $freq = $_POST['frequency'];
        $wday = $_POST['weekday'];
        $start = $_POST['start'];
        
        
        $this->loadModel('cleaning');
        $this->model->create($title, $freq, $wday, $start);
    }

}
