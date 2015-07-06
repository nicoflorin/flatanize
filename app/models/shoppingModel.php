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
    public function add($flatId, $product, $amount) {


        $bind = array(
            ':flatId' => $flatId,
            ':product' => $product,
            ':amount' => $amount
        );
        // Füre DB Insert aus
        $this->db->insert('flats', 'flats_id, product, amount', ':flatId, :product, :amount', $bind);
    }

}
