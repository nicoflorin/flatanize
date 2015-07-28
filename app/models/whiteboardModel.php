<?php
/**
 * Verarbeitet die Whiteboard Logik
 *
 * @author Nico
 */
class whiteboardModel extends Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Fügt einen neuen Eintrag zum Whiteboard hinzu
     * @param int $flatId
     * @param int $userId
     * @param string $text
     * @return boolean
     */
    public function addToWhiteboard($flatId, $userId, $text) {

        $bind = array(
            ':flatId' => $flatId,
            ':userId' => $userId,
            ':text' => $text
        );
        // Füre DB Insert aus
        $res = $this->db->insert('whiteboards', 'flats_id, users_id, text', ':flatId, :userId, :text', $bind);
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }
    
     /**
      * Holt gewisse Anzahl von Whiteboard Einträgen aus DB
      * @param int $flatId
      * @param int $limit
      * @return array
      */
    public function getWhiteboardList($flatId, $limit = '25') {
        // Select auf whiteboard
        $bind = array(
            ':flatId' => $flatId
        );
        $res = $this->db->select(
                'a.id, a.text, a.timestamp, b.display_name', 
                'whiteboards a, users b',
                'a.users_id = b.id AND a.flats_id = :flatId order by a.timestamp desc LIMIT 15', 
                $bind
        );
        
        //Zurückgeben, sonst leeres Array
        if (!empty($res)) {
            return $res;
        } else {
            return array();
        }
    }
}
