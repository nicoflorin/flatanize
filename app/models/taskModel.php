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
    public function create($flatId, $title, $freq, $wday, $nextDate, $users) {
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
            ':nextDate' => $nextDate
        );
        $res = $this->db->insert('tasks', 'flats_id, frequencies_id, wdays_id, title, next_date', ':flatId, :freqId, :wdayId, :title, :nextDate', $bind);
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
     * @return boolean
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
     * Holt für einen Task den aktiven User aus der DB
     * @param type $flatId
     * @param type $taskId
     */
    public function getActiveUser($flatId, $taskId) {
        $bind = array(
            ':flatId' => $flatId,
            ':taskId' => $taskId
        );
        $res = $this->db->select('a.id, d.description, e.day, a.title, a.next_date, c.display_name'
                , 'tasks a, tasks_users b, users c, frequencies d, wdays e'
                , 'a.id = b.tasks_id
                    AND c.id = b.users_id
                    AND d.id = a.frequencies_id
                    AND e.id = a.wdays_id
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
    public function setTaskDone($id, $userId) {
        $bind = array(
            ':id' => $id,
            ':userId' => $userId
        );

        $res = $this->db->update('tasks_users', 'count = count+1', 'tasks_id = :id AND users_id = :userId', $bind);

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
     * @param type $day
     */
    public function calcNextDate($date, $freq, $day) {
        $date = new DateTime($date);
        
        switch ($freq) {
            case 'once':
                $return = $date->format('y-m-d');
                break;

            case 'daily':
                $date = $date->modify('+1 day');
                $return = $date->format('y-m-d');
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

}
