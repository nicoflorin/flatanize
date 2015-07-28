<?php

/**
 * Verarbeitet die WG Logik
 *
 * @author Nico
 */
class FlatModel extends Model {

    function __construct() {
        parent::__construct();
    }
    
    /**
     * Erstellt eine WG und verlinkt den User mit dieser WG
     */
    public function create($flatName, $userId) {

        //Falls kein Flat Name eingegeben wurde
        $error = [];
        if (empty($flatName)) {
            $error['error_msg'] = 'Please enter a name for your flat!';
            return $error;
        }

        $next = true;
        do {
            $code = Functions::createRandomCode(5);

            $bind = array(':flat_code' => $code);
            $res = $this->db->select('code', 'flats', 'code = :flat_code LIMIT 1', $bind);

            // Bei Treffer auf DB
            if (empty($res)) {
                $bind = array(
                    ':flatName' => $flatName,
                    ':code' => $code
                );
                // Füre DB Insert aus
                $res = $this->db->insert('flats', 'name, code', ':flatName, :code', $bind);
                $flatId = $this->db->lastInsertId();
                Session::setFlatId($flatId);
                //@Todo Besser lösen als so
                require_once ROOT . '/app/models/userModel.php';
                $user = new UserModel();
                $user->linkUserToFlat($userId, $flatId);
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
        $res = $this->db->update('users', 'flats_id = NULL', 'id = :userId', $bind);

        // Bei Update in DB
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * fügt einen Benutzer einer bestehenden WG hinzu
     */
    public function join($userId, $flatCode) {

        //Falls kein Flat Code eingegeben wurde
        $error = [];
        if (empty($flatCode)) {
            $error['error_msg'] = 'Please enter a flat code!';
            return $error;
        }

        //Suche nach WG mit diesem Code
        $bind = array(':flatCode' => $flatCode);
        $res = $this->db->select('id', 'flats', 'code = :flatCode LIMIT 1', $bind);

        if (!empty($res)) {//Fals eine WG zurück kam
            $flatId = $res[0]['id'];

            //Füge User WG hinzu
            $bind = array(
                ':userId' => $userId,
                ':flatId' => $flatId,
            );
            $res = $this->db->update('users', 'flats_id = :flatId', 'id = :userId', $bind);

            // Bei Update in DB
            if ($res == 1) {
                //Session var schreiben
                Session::setFlatId($flatId);
                return true;
            } else {
                return false;
            }
        } else { //Wenn es die WG nicht gibt, false zurückgeben
            $error['error_msg'] = 'Flat Code not valid!';
            return $error;
        }
    }

    /**
     * Holt den WG Code aus der DB
     * @param int $flatId
     */
    public function getFlatCode($flatId) {
        //Suche nach WG mit dieser Id
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select('code', 'flats', 'id = :flatId LIMIT 1', $bind);

        //Fals ein WG Code zurück kam
        if (!empty($res)) {
            return $res[0]['code'];
        } else {
            return false;
        }
    }

    /**
     * Holt den WG Namen aus der DB
     * @param int $flatId
     */
    public function getFlatName($flatId) {
        //Suche nach WG mit dieser Id
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select('name', 'flats', 'id = :flatId LIMIT 1', $bind);

        //Fals ein WG Name zurück kam
        if (!empty($res)) {
            return $res[0]['name'];
        } else {
            return false;
        }
    }

    /**
     * Holt alle usersId aus einer WG
     * @param type $flatId
     */
    public function getFlatUsers($flatId) {
        //Suche nach WG mit dieser Id
        $bind = array(':flatId' => $flatId);
        $res = $this->db->select('id, display_name', 'users', 'flats_id = :flatId', $bind);

        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

}
