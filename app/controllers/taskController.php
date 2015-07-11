<?php

/**
 * Controller für Aufgabenplanung
 *
 * @author Nico
 */
class TaskController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin(); //Prüft ob User eingeloggt
    }

    /**
     * Lädt Task index Seite
     */
    public function index() {
        $flatId = Session::getFlatId();
        $this->view->taskList = $this->getTaskList($flatId);
        //Seite laden
        $this->view->render('task/index', 'Task Scheduling');
    }

    /**
     * Holt alle Tasks und holt für jeden den aktiven User
     * @param type $flatId
     * @return type
     */
    public function getTaskList($flatId) {
        $taskList = array();
        $newTaskList = array();
        $this->loadModel('task');

        $list = $this->model->getTaskList($flatId);

        //Holt für jeden Task den akiven User
        foreach ($list as $entry) {
            $taskList[] = $this->model->getActiveUser($flatId, $entry['id']);
        }

        //Da dreidimensionales Array, dieses zu zweidimensional machen
        foreach ($taskList as $entry) {
            $newTaskList[] = $entry[0];
        }

        for ($i = 0; $i < count($newTaskList); $i++) {
            $newTaskList[$i]['day'] = $this->model->getWeekday($newTaskList[$i]['next_date']);
        }
        return $newTaskList;
    }

    /**
     * Lädt Seite um neuen Task zu erstellen
     * @param type $error
     */
    public function showCreateTask(...$error) {
        //Hole Displayname für alle User einer WG
        $this->loadModel('user');
        $userNames = $this->model->getAllDisplayNames(Session::getFlatId());

        //userliste an View übergeben
        $this->view->userList = $userNames;

        //Prüfen ob Fehler übermittelt
        foreach ($error as $value) {
            switch ($value) {
                case 'users':
                    $this->view->assign('users', true);
                    break;
                case 'date':
                    $this->view->assign('date', true);
                    break;
            }
        }

        $this->view->render('task/create_task', 'Task Scheduling');
    }

    /**
     * Handelt create Task Form Input und ruft Model für Erstellung auf
     */
    public function createTask() {
        $title = $_POST['title'];
        $freq = $_POST['frequency'];
        $start = $_POST['start'];
        $users = (isset($_POST['user'])) ? $_POST['user'] : ''; //Array, falls nicht gesetzt leer lassen
        $flatId = Session::getFlatId();

        //@Todo erster User anhand von Reihenfolge Auswahl in GUI
        $this->loadModel('task');

        $error = [];
        //Prüfe ob Datum format 
        if (Functions::validateDate($start)) { //Y-m-d
        } else if (Functions::validateDate($start, 'd.m.Y')) {
            $start = Functions::formatDate($start); //formatiere Datum in Format y-m-d
        } else { //Kein Datum im gewünschten Format
            $error[] = 'date';
        }

        //Wenn keine Users 
        if (empty($users)) {
            $error[] = 'users';
        }

        //Wenn keine Fehler auftraten
        if (empty($error)) {

            $res = $this->model->create($flatId, $title, $freq, $start, $users);

            if ($res === true) {
                $this->redirect('task', 'index');
            } else {
                $this->redirect('task', 'showCreateTask');
            }
        } else {
            $this->redirect('task', 'showCreateTask', $error);
        }
    }

    /**
     * Löscht einen Task aus DB
     */
    public function deleteTask() {
        //@Todo prüfen ob User berechtigt
        $id = $_POST['id'];
        if (!empty($id)) {
            $this->loadModel('task');
            $this->model->deleteTask($id);
        }

        $this->redirect('task', 'index');
    }

    /**
     * Setzt den Task für den eingeloggten User auf erledigt
     */
    public function setTaskDone() {
        //@Todo prüfen ob User berechtigt
        $id = $_POST['id'];
        if (!empty($id)) {
            $userId = Session::get('user_id');
            $this->loadModel('task');
            $res = $this->model->getTask($id);
            $date = $res[0]['next_date'];
            $freq = $res[0]['description'];

            // Bei einmaligem Task diesen löschen
            if ($freq == ONCE) {
                $res = $this->model->deleteTask($id);
            } else {
                // Berechne neues Datum
                $nextDate = $this->model->calcNextDate($date, $freq);

                $res = $this->model->updateTask($id, $userId, $nextDate);
            }
        }

        $this->redirect('task', 'index');
    }

}
