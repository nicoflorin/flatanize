<?php
/**
 * Description of financeModel
 *
 * @author Nico
 */
class FinanceModel extends Model{
    
    public function create($flatId, $product, $price, $date, $users) {
        //Füge Daten in DB ein
        $bind = array(
            ':flatId' => $flatId,
            ':product' => $product,
            ':price' => $price,
            ':date' => $date
        );
        $res = $this->db->insert('finances', 'flats_id, product, price, date', ':flatId, :product, :price, :date', $bind);
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
}
