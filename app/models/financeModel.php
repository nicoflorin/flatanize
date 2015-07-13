<?php

/**
 * Description of financeModel
 *
 * @author Nico
 */
class FinanceModel extends Model {

    /**
     * Erstellt einen neuen Finanz Eintrag in DB
     * @param type $flatId
     * @param type $userId
     * @param type $product
     * @param type $price
     * @param type $date
     * @param type $users
     * @return boolean
     */
    public function create($flatId, $userId, $product, $price, $date, $users, $pricePP) {
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
                $this->setFinancesUser($user, $financesId, $pricePP);
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
    public function setFinancesUser($userId, $financesId, $pricePP) {
        //Füge Daten in DB ein
        $bind = array(
            ':userId' => $userId,
            ':financesId' => $financesId,
            ':pricePP' => $pricePP
        );
        $res = $this->db->insert(
                'finances_users', 'finances_id, users_id, pricePP', ':financesId, :userId, :pricePP', $bind);

        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Holt die Liste der Finanzeinträge, welche nicht gecleared sind
     * @param type $flatId
     * @return array
     */
    public function getFinanceList($flatId) {
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select(
                'a.id, c.display_name, a.product, a.price, a.date, count(*) user_count', 'finances a, finances_users b, users c', 'b.finances_id = a.id
                AND a.added_by = c.id
                AND a.flats_id = :flatId
                AND cleared = 0
                group by b.finances_id
                order by a.date desc, a.product', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

    /**
     * Holt alle Users eines Finance Eintrages aus der DB
     * @param type $financesId
     * @return array
     */
    public function getUsersOfFinanceEntry($financesId) {
        $bind = array(':financesId' => $financesId);
        $res = $this->db->select(
                'a.users_id, b.display_name', 'finances_users a, users b', 'a.users_id = b.id
                AND a.finances_id = :financesId', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

    /**
     * Holt die Summe der bezahlten Einträge pro Benutzer, welche nicht gecleared sind
     * @param type $flatId
     * @return array
     */
    public function getSumOfUser($flatId, $userId) {
        $bind = array(
            ':flatId' => $flatId,
            ':userId' => $userId
        );
        $res = $this->db->select(
                'added_by, sum(price) as sum', 'finances', 
                'cleared = 0
                AND flats_id = :flatId
                AND added_by = :userId
                GROUP BY added_by', $bind);

        if (!empty($res)) {
            return $res[0]['sum'];
        } else {
            return 0; //sonst null
        }
    }
    
    /**
     * Holt alle Einträge für einen Benutzer an denen er beteiligt war
     * @param type $flatId
     * @param type $userId
     * @return type
     */
    public function getEntriesPerUser ($flatId, $userId) {
        $bind = array(
            ':flatId' => $flatId,
            ':userId' => $userId
        );
        $res = $this->db->select(
                'a.id, b.users_id, a.price', 'finances a, finances_users b', 'a.id = b.finances_id
                AND users_id = :userId
                AND a.flats_id = :flatId
                AND a.cleared = 0', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst total = 0
        }
    }
    
    /**
     * Holt das Total zu bezahlende pro User
     * @param type $flatId
     * @param type $userId
     * @return type
     */
    public function getTotalOfUser($flatId, $userId) {
        $bind = array(
                    ':flatId' => $flatId,
                    ':userId' => $userId
                );
        $res = $this->db->select(
                'sum(pricePP) as total',
                'finances a, finances_users b',
                'a.id = b.finances_id
                and a.flats_id = :flatId
                and b.users_id = :userId
                and a.cleared = 0', $bind);

        if (!empty($res)) {
            return $res[0]['total'];
        } else {
            return array(); //sonst total = 0
        }
    }
    
    /**
     * Rechnet für eine WG die Balance ab
     * @param type $flatId
     * @return boolean
     */
    public function clearBalance($flatId) {
        $bind = array(
            ':flatId' => $flatId
        );

        $res = $this->db->update('finances', 'cleared = 1', 'flats_id = :flatId', $bind);

        if ($res > 0) {
            return true;
        } else {
            return false;
        }
    }

}
