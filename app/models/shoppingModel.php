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
    public function add($flatId, $product, $amount = "") {

        $bind = array(
            ':flatId' => $flatId,
            ':product' => $product,
            ':amount' => $amount
        );
        // Füre DB Insert aus
        $res = $this->db->insert('shopping_lists', 'flats_id, product, amount', ':flatId, :product, :amount', $bind);
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
        return $res;
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
        
        return $res;
    }

}
