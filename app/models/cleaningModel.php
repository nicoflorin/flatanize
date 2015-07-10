<?php

/**
 * Description of cleaningModel
 *
 * @author Nico
 */
class cleaningModel extends Model {

    /**
     * Erstellt einen neuen Cleaning Task
     */
    public function create($flatId, $title, $freq, $wday, $start, $users) {
        //Hole wochenTag ID aus DB
        $bind = array(':wday' => $wday);
        $res = $this->db->select('id', 'wdays', 'day = :wday LIMIT 1', $bind);
        $wdayId = $res[0]['id'];

        //Hole Frequenz ID aus DB
        $bind = array(':freq' => $freq);
        $res = $this->db->select('id', 'frequencies', 'description = :freq LIMIT 1', $bind);
        $freqId = $res[0]['id'];

        //Füge Daten in DB ein
        $bind = array(
            ':flatId' => $flatId,
            ':freqId' => $freqId,
            ':wdayId' => $wdayId,
            ':title' => $title,
            ':start' => $start
        );
        $res = $this->db->insert('cleanings', 'flats_id, frequencies_id, wdays_id, title, start', ':flatId, :freqId, :wdayId, :title, :start', $bind);
        $cleaningId = $this->db->lastInsertId();

        //Wenn OK
        if ($res == 1) {
            //Erstelle für jeden User einen Eintrag in cleaning_users
            //@Todo UserOrder aus GUI übernehmen
            $userOrder = 1;
            foreach ($users as $user) {
                $this->setCleaningUser($user, $cleaningId, $userOrder);
                $userOrder++;
            }
            
            return true;
        }else {
            return false;
        }
    }

    /**
     * Setzt Werte in n:m tabelle cleanings_users
     * @param type $userId
     * @param type $cleaningId
     * @param type $orderNr
     * @return boolean
     */
    public function setCleaningUser($userId, $cleaningId, $userOrder=1, $count=0) {
        //Füge Daten in DB ein
        $bind = array(
            ':userId' => $userId,
            ':cleaningId' => $cleaningId,
            ':userOrder' => $userOrder,
             ':count' => $count   
        );
        $res = $this->db->insert('cleanings_users', 'cleanings_id, users_id, user_order, count', ':cleaningId, :userId, :userOrder, :count', $bind);

        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Holt anhand der flatId alle WG Tasks aus DB
     * @param type $flatId
     * @return boolean
     */
    public function getTaskList($flatId) {
        //Inner Join auf cleanings, frequencies, wdays
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select('a.id, a.flats_id, a.title, a.start, b.description, c.day', 'cleanings a, frequencies b, wdays c', 'a.frequencies_id = b.id AND a.wdays_id = c.id AND flats_id = :flatId', $bind);
        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

}
