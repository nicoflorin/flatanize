<?php
/**
 * Description of financeModel
 *
 * @author Nico
 */
class FinanceModel extends Model{
    
    public function create($flatId, $userId, $product, $price, $date, $users) {
        //Füge Daten in DB ein
        $bind = array(
            ':flatId' => $flatId,
            ':userId' => $userId,
            ':product' => $product,
            ':price' => $price,
            ':date' => $date
        );
        $res = $this->db->insert('finances', 'flats_id, added_by, product, price, date', ':flatId, :userId, :product, :price, :date', $bind);
        $financesId = $this->db->lastInsertId();

        //Wenn OK
        if ($res == 1) {
            //Erstelle für jeden User einen Eintrag in finances_users
            foreach ($users as $user) {
                $this->setFinancesUser($user, $financesId);
            }

            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Erstellt die Einträge in finances_users
     * @param type $userId
     * @param type $financesId
     * @return boolean
     */
    public function setFinancesUser($userId, $financesId) {
        //Füge Daten in DB ein
        $bind = array(
            ':userId' => $userId,
            ':financesId' => $financesId,
        );
        $res = $this->db->insert('finances_users', 'finances_id, users_id', ':financesId, :userId', $bind);

        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Holt die Liste der Finanzeinträge, welche nicht gecleared sind
     * @param type $flatId
     */
    public function getFinanceList($flatId) {
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select(
                'a.id, c.display_name, product, a.price, a.date, count(*) user_count', 
                'finances a, finances_users b, users c',
                'b.finances_id = a.id
                AND a.added_by = c.id
                AND a.flats_id = :flatId
                AND cleared = 0
                group by b.finances_id
                order by a.date desc', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }
    
    /**
     * Holt alle Users eines Finance Eintrages aus der DB
     * @param type $financesId
     * @return type
     */
    public function getUsersOfFinanceEntry($financesId) {
        $bind = array(':financesId' => $financesId);
        $res = $this->db->select(
                'a.users_id, b.display_name', 
                'finances_users a, users b',
                'a.users_id = b.id
                AND a.finances_id = :financesId', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }
}
