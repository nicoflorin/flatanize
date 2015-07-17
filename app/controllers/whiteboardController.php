<?php

/**
 * Controller für Whiteboard
 *
 * @author Nico
 */
class WhiteboardController extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkLogin();
    }

    /**
     * Lädt Whiteboard Index Seite
     */
    public function index() {
        $flatId = Session::getFlatId();

        $this->loadModel('whiteboard');
        //Hole letzte 25 Einträge aus Whiteboard
        $Whiteboardlist = $this->model->getWhiteboardList($flatId, '25');

        $list = array();
        //Loop durch Liste
        foreach ($Whiteboardlist as $key => $entry) {
            $date = new DateTime($entry['timestamp']);
            $time = $date->format('H:i'); //Uhrzeit
            $date = $date->format('d.m.Y'); //Datum
            //Gruppiere werte nach Datum
            $list[$date][$key]['text'] = $entry['text'];
            $list[$date][$key]['time'] = $time;
            $list[$date][$key]['display_name'] = $entry['display_name'];
        }


        //Übergebe Datn an View
        $this->view->whiteboardList = $list;
        $this->view->render('whiteboard/index', 'Whiteboard');
    }

    /**
     * Fügt einen neuen Eintrag zum Whiteboard hinzu
     */
    public function addToWhiteboard() {
        $text = strip_tags($_POST['text']);
        $userId = Session::getUserId();
        $flatId = Session::getFlatId();

        //Falls kein Text eingegeben wurde
        if (!empty($text)) {
            $this->loadModel('whiteboard');
            $res = $this->model->addToWhiteboard($flatId, $userId, $text);
        }

        $this->redirect('whiteboard', 'index');
    }

}
