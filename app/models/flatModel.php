<?php

/**
 * Description of flatModel
 *
 * @author Nico
 */
class flatModel extends Model {

    /**
     * Erstellt eine WG und verlinkt den User mit dieser WG
     */
    public function create($name, $userId) {
        $in_flatName = $name;
        $in_userId = $userId;

        //Falls kein Flat Name eingegeben wurde
        $error = [];
        if (empty($in_flatName)) {
            $error['error_msg'] = 'Please enter a name for your flat!';
            return $error;
        }

        $next = true;
        do {
            $code = $this->createRandomCode(5);

            $bind = array(':flat_code' => $code);
            $res = $this->db->select('code', 'flats', 'code = :flat_code', $bind);

            // Bei Treffer auf DB
            if (empty($res)) {
                $bind = array(
                    ':flatName' => $in_flatName,
                    ':code' => $code
                );
                // Füre DB Insert aus
                $res = $this->db->insert('flats', 'name, code', ':flatName, :code', $bind);
                $flat_id = $this->db->lastInsertId();
                $this->setFlatId($flat_id);
                $user = new UserModel();
                $user->linkUserToFlat($in_userId, $flat_id);
                $next = false;
            }
        } while ($next);

        // Wenn keine Fehler
        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Löscht bei einem User die WG Verlinkung
     */
    public function leave($userId) {
        $bind = array(':userId' => $userId);
        $res = $this->db->update('users', 'flat_id = NULL', 'id = :userId', $bind);
        
        // Bei Update in DB
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
        
        
    }

    /**
     * Erstellt einen zufälligen String
     * @param int $length
     * @return string
     */
    private function createRandomCode($length) {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[mt_rand(0, 61)];
        }
        return $result;
    }

    /**
     * Setzt die Session Variable flat_id
     */
    public function setFlatId($id) {
        Session::set('flat_id', $id);
    }

}
