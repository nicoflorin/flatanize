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
        $this->loadModel('cleaning');
        $flatId = Session::getFlatId();
        //Hole Liste von Tasks
        $this->view->taskList = $this->model->getTaskList($flatId);
        $this->view->render('cleaning/index', 'Cleaning Tasks');
    }

    /**
     * Lädt Seite um neuen Task zu erstellen
     */
    public function showCreateTask($error = '') {
        $this->loadModel('flat');
        $users = $this->model->getFlatUsers(Session::getFlatId());

        //Hole Displayname für alle User einer WG
        $this->loadModel('user');
        foreach ($users as $user) {
            $usersName[$user['id']] = $this->model->getDisplayName($user['id']);
        }

        //userliste an View übergeben
        $this->view->userList = $usersName;

        //Prüfen ob Fehler übermittelt
        switch ($error) {
            case 'users':
                $this->view->assign('users', true);
                break;
            case 'date':
                $this->view->assign('date', true);
                break;
        }

        $this->view->render('cleaning/create_task', 'Cleaning Tasks');
    }

    public function createTask() {
        $title = $_POST['title'];
        $freq = $_POST['frequency'];
        $wday = $_POST['weekday'];
        $start = $_POST['start'];
        $users = $_POST['user'];
        $flatId = Session::getFlatId();

        $error = [];
        //Prüfe ob Datum format 
        if ($this->validateDate($start)) { //Y-m-d
        } else if ($this->validateDate($start, 'd.m.Y')) {
            $start = $this->formatDate($start); //formatiere Datum in Format y-m-d
        } else { //Kein Datum im gewünschten Format
            $error['date'] = 'date';
        }

        //Wenn keine Users 
        if (empty($users)) {
            $error['users'] = 'users';
        }

        //Wenn keine Fehler auftraten
        if (empty($error)) {
            $this->loadModel('cleaning');
            $res = $this->model->create($flatId, $title, $freq, $wday, $start, $users);
            if ($res === true) {
                $this->redirect('cleaning', 'index');
            } else {
                $this->redirect('cleaning', 'showCreateTask');
            }
        } else {
            $this->redirect('cleaning', 'showCreateTask', $error);
        }
    }

    /**
     * Prüft einen String auf das korrekte Datum Format
     * @param string $date
     * @param string $format
     * @return boolean
     */
    public function validateDate($date, $format = 'Y-m-d') {
        try {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Formatiert ein DateTime in das gewünschte Format
     * @param DateTime $date
     * @param string $format
     */
    public function formatDate($date, $format = 'Y-m-d') {
        $out = new DateTime($date);
        return $out->format($format);
    }

}
