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
        $flatId = Session::getFlatId();
        $this->view->taskList = $this->getTaskList($flatId);
        //Seite laden
        $this->view->render('cleaning/index', 'Task Scheduling');
    }

    /**
     * Holt alle Tasks und holt für jeden den aktiven User
     * @param type $flatId
     * @return type
     */
    public function getTaskList($flatId) {
        $taskList = array();
        $newTaskList = array();
        $this->loadModel('cleaning');

        $list = $this->model->getTaskList($flatId);

        //Holt für jeden Task den akiven User
        foreach ($list as $entry) {
            $taskList[] = $this->model->getActiveUser($flatId, $entry['id']);
        }

        //Da dreidimensionales Array, dieses zu zweidimensional machen
        foreach ($taskList as $entry) {
            $newTaskList[] = $entry[0];
        }

        return $newTaskList;
    }
    
    /**
     * Berechnet das nächste Datum für Task
     * @param type $date
     * @param type $freq
     * @param type $day
     */
    public function calcNextDate($date, $freq, $day) {
        switch ($freq) {
            case 'once':
                $return = $date;
                break;
            
            case 'daily':
                $return = $date+1;
                break;
            
            case 'weekly':
                

                break;
            
            case 'every month':
                

                break;

            default:
                break;
        }
        
        return $return;
    }

    /**
     * Lädt Seite um neuen Task zu erstellen
     * @param type $error
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

        $this->view->render('cleaning/create_task', 'Task Scheduling');
    }

    /**
     * Handelt create Task Form Input und ruft Model für Erstellung auf
     */
    public function createTask() {
        $title = $_POST['title'];
        $freq = $_POST['frequency'];
        $wday = $_POST['weekday'];
        $start = $_POST['start'];
        $users = $_POST['user'];
        $flatId = Session::getFlatId();
        //@Todo erster User anhand von Reihenfolge Auswahl in GUI

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
     * Löscht einen Task aus DB
     * @param type $id
     */
    public function deleteTask($id) {
        $this->loadModel('cleaning');
        $res = $this->model->deleteTask($id);

        $this->redirect('cleaning', 'index');
    }
    
    /**
     * Setzt den Task für den eingeloggten User auf erledigt
     * @param type $id
     */
    public function setTaskDone($id) {
        $userId = Session::get('user_id');
        $this->loadModel('cleaning');
        $res = $this->model->setTaskDone($id, $userId);

        $this->redirect('cleaning', 'index');
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
