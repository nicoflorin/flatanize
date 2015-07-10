<?php

/**
 * Description of shoppingModel
 *
 * @author Nico
 */
class shoppingModel extends Model {

    /**
     * Fügt einen neuen Eintrag zur Shopping List hinzu
     */
    public function add($flatId, $product, $amount = "", $userId) {

        $bind = array(
            ':flatId' => $flatId,
            ':product' => $product,
            ':amount' => $amount,
            ':userId' => $userId
        );
        // Füre DB Insert aus
        $res = $this->db->insert('shopping_lists', 'flats_id, product, amount, added_by', ':flatId, :product, :amount, :userId', $bind);
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Löscht einen Eintrag aus der Shopping List
     * @param type $id
     */
    public function delete($id) {
        $bind = array(
            ':id' => $id
        );
        // Füre DB Delete aus
        $res = $this->db->delete('shopping_lists', 'id = :id', $bind);

        if ($res > 0) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * Holt alle Shopping List Einträge aus der DB
     * @param type $flatId
     * @return type
     */
    public function getList($flatId) {
        // Select auf diese Flat
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select('id, product, amount', 'shopping_lists', 'flats_id = :flatId', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

}
