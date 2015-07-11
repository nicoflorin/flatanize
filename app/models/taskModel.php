<?php

/**
 * Description of taskModel
 *
 * @author Nico
 */
class taskModel extends Model {

    /**
     * Erstellt einen neuen Task
     */
    public function create($flatId, $title, $freq, $nextDate, $users) {
        //Hole Frequenz ID aus DB
        $bind = array(':freq' => $freq);
        $res = $this->db->select('id', 'frequencies', 'description = :freq LIMIT 1', $bind);
        $freqId = $res[0]['id'];
        
        //Füge Daten in DB ein
        $bind = array(
            ':flatId' => $flatId,
            ':freqId' => $freqId,
            ':title' => $title,
            ':nextDate' => $nextDate
        );
        $res = $this->db->insert('tasks', 'flats_id, frequencies_id, title, next_date', ':flatId, :freqId, :title, :nextDate', $bind);
        $taskId = $this->db->lastInsertId();

        //Wenn OK
        if ($res == 1) {
            //Erstelle für jeden User einen Eintrag in task_users
            //@Todo UserOrder aus GUI übernehmen
            $userOrder = 1;
            foreach ($users as $user) {
                $this->setTaskUser($user, $taskId, $userOrder);
                $userOrder++;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Setzt Werte in n:m tabelle tasks_users
     * @param type $userId
     * @param type $taskId
     * @param type $orderNr
     * @return boolean
     */
    public function setTaskUser($userId, $taskId, $userOrder = 1, $count = 0) {
        //Füge Daten in DB ein
        $bind = array(
            ':userId' => $userId,
            ':taskId' => $taskId,
            ':userOrder' => $userOrder,
            ':count' => $count
        );
        $res = $this->db->insert('tasks_users', 'tasks_id, users_id, user_order, count', ':taskId, :userId, :userOrder, :count', $bind);

        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Holt anhand der flatId alle WG Tasks aus DB
     * @param type $flatId
     * @return array
     */
    public function getTaskList($flatId) {
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select('id', 'tasks', 'flats_id = :flatId', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

    /**
     * Holt einen Task aus der DB
     * @param type $id
     * @return array
     */
    public function getTask($id) {
        $bind = array(':id' => $id);
        $res = $this->db->select(
                'a.id, a.flats_id, a.title, a.next_date, b.description', 
                'tasks a, frequencies b', 
                'a.id = :id AND a.frequencies_id = b.id', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

    /**
     * Holt für einen Task den aktiven User aus der DB
     * @param type $flatId
     * @param type $taskId
     */
    public function getActiveUser($flatId, $taskId) {
        //@Todo evtl. View erstellen
        $bind = array(
            ':flatId' => $flatId,
            ':taskId' => $taskId
        );
        $res = $this->db->select(
                'a.id, d.description, a.title, a.next_date, c.display_name'
                , 'tasks a, tasks_users b, users c, frequencies d'
                , 'a.id = b.tasks_id
                    AND c.id = b.users_id
                    AND d.id = a.frequencies_id
                    AND a.flats_id = :flatId
                    AND b.tasks_id = :taskId
                    order by b.count, b.user_order
                    LIMIT 1;', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

    /**
     * Löscht einen Task aus der DB
     * @param type $id
     * @return boolean
     */
    public function deleteTask($id) {
        $bind = array(
            ':id' => $id
        );
        // Füre DB Delete auf tasks_users aus
        $res = $this->db->delete('tasks_users', 'tasks_id = :id', $bind);
        if ($res > 0) {
            // Füre DB Delete auf tasks aus
            $res = $this->db->delete('tasks', 'id = :id', $bind);
            if ($res > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Setzt einen Task für einen User auf erledigt
     * @param type $id
     * @param type $userId
     * @return boolean
     */
    public function updateTask($id, $userId, $nextDate) {
        $bind = array(
            ':id' => $id,
            ':userId' => $userId
        );

        $res = $this->db->update('tasks_users', 'count = count+1', 'tasks_id = :id AND users_id = :userId', $bind);

        $bind = array(
            ':id' => $id,
            ':nextDate' => $nextDate
        );

        $res = $this->db->update('tasks', 'next_date = :nextDate', 'id = :id', $bind);

        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Berechnet das nächste Datum für Task
     * @param type $date
     * @param type $freq
     */
    public function calcNextDate($date, $freq) {
        $date = new DateTime($date);

        switch ($freq) {
            case ONCE:
                $ret = $date->format('y-m-d');
                break;

            case DAILY:
                $date = $date->modify('+1 day');
                $ret = $date->format('y-m-d');
                break;

            case WEEKLY:
                $date = $date->modify('+1 week');
                $ret = $date->format('y-m-d');
                break;

            case MONTHLY:
                $date = $date->modify('+1 month');
                $ret = $date->format('y-m-d');
                break;

            default:
                break;
        }

        return $ret;
    }
    
        /**
     * Gibt Wochentag zurück
     * @param type $date
     * @return type
     */
    function getWeekday($date) {
        $day = date('w', strtotime($date));

        $ret = '';
        switch ($day) {
            case 0:
                $ret = SUNDAY;
                break;
            case 1:
                $ret = MONDAY;
                break;
            case 2:
                $ret = TUESDAY;
                break;
            case 3:
                $ret = WEDNESDAY;
                break;
            case 4:
                $ret = THURSDAY;
                break;
            case 5:
                $ret = FRIDAY;
                break;
            case 6:
                $ret = SATURDAY;
                break;
            default:
                break;
        }
        return $ret;
    }

}
