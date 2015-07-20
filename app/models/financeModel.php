<?php

/**
 * Verarbeitet die Finanzlogik
 *
 * @author Nico
 */
class FinanceModel extends Model {

    /**
     * Erstellt einen neuen Finanz Eintrag in DB
     * @param int $flatId
     * @param int $userId
     * @param string $product
     * @param float $price
     * @param date $date
     * @param array $users
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
     * Löscht einen Eintrag aus der DB
     * @param int $id
     * @return boolean
     */
    public function deleteEntry($id) {
        $bind = array(
            ':id' => $id
        );
        // Füre DB Delete auf tasks_users aus
        $res = $this->db->delete('finances_users', 'finances_id = :id', $bind);
        if ($res > 0) {
            // Füre DB Delete auf tasks aus
            $res = $this->db->delete('finances', 'id = :id', $bind);
            if ($res > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Erstellt die Einträge in finances_users
     * @param int $userId
     * @param int $financesId
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
     * @param int $flatId
     * @return array
     */
    public function getFinanceList($flatId) {
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select(
                'a.id, c.display_name, a.product, a.price, a.date, count(*) user_count, a.timestamp', 'finances a, finances_users b, users c', 'b.finances_id = a.id
                AND a.added_by = c.id
                AND a.flats_id = :flatId
                AND cleared = 0
                group by b.finances_id
                order by a.timestamp desc', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return array(); //sonst leeres Array
        }
    }

    /**
     * Holt alle Users eines Finance Eintrages aus der DB
     * @param int $financesId
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
     * @param int $flatId
     * @return int
     */
    public function getSumOfUser($flatId, $userId) {
        $bind = array(
            ':flatId' => $flatId,
            ':userId' => $userId
        );
        $res = $this->db->select(
                'added_by, sum(price) as sum', 'finances', 'cleared = 0
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
     * @param int $flatId
     * @param int $userId
     * @return array
     */
    public function getEntriesPerUser($flatId, $userId) {
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
     * @param int $flatId
     * @param int $userId
     * @return int
     */
    public function getTotalPerUser($flatId, $userId) {
        $bind = array(
            ':flatId' => $flatId,
            ':userId' => $userId
        );
        $res = $this->db->select(
                'sum(pricePP) as total', 'finances a, finances_users b', 'a.id = b.finances_id
                and a.flats_id = :flatId
                and b.users_id = :userId
                and a.cleared = 0', $bind);

        if (!empty($res)) {
            return $res[0]['total'];
        } else {
            return 0; //sonst total = 0
        }
    }

    /**
     * Holt das Total aller Einträge einer WG
     * @param int $flatId
     * @return int
     */
    public function getTotal($flatId) {
        $bind = array(
            ':flatId' => $flatId
        );
        $res = $this->db->select(
                'sum(price) as total', 'finances', 'flats_id = :flatId
                and cleared = 0', $bind);

        if (!empty($res)) {
            return $res[0]['total'];
        } else {
            return 0; //sonst total = 0
        }
    }

    /**
     * Rechnet für eine WG die Balance ab
     * @param int $flatId
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

    /**
     * Berechnet Balance Informationen
     * @param int $flatId
     * @param int $flatUsers
     * @return array|boolean
     */
    public function calcBalanceInfos($flatId, $flatUsers) {

        $usersBalance = $flatUsers;

        //Hole Total aller Einträge für WG
        $total = 0;

        if (!empty($usersBalance)) {
            //Berechne Differenz von Total Bezahlt - SOLL bezahlt pro User
            foreach ($usersBalance as $key => $user) {
                $userId = $user['id'];
                $usersBalance[$key]['sum'] = $this->getSumOfUser($flatId, $userId); //Was User effektiv bezahlt hat
                $usersBalance[$key]['total'] = $this->getTotalPerUser($flatId, $userId); //Was User zahlen muss
                $usersBalance[$key]['diff'] = round($usersBalance[$key]['sum'] - $usersBalance[$key]['total'], 2);

                //Total Berechnen (Total = 100%)
                if ($usersBalance[$key]['diff'] > 0) {
                    $total += $usersBalance[$key]['diff'];
                }
            }

            foreach ($usersBalance as $key => $user) {
                //Prozentsatz von Differenz zu Total
                $oneperc = $total / 100;

                //Division durch null vermeiden
                if ($oneperc > 0 && $usersBalance[$key]['diff'] != 0) {
                    $usersBalance[$key]['perc'] = abs(round($usersBalance[$key]['diff'] / $oneperc));
                } else {
                    $usersBalance[$key]['perc'] = 100;
                }
            }

            return $usersBalance;
        } else {
            return false;
        }
    }

}
