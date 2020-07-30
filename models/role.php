<?php
require_once '../models/connection.php';

class Role {

    public static function all_roles() {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM roles WHERE `status` = 1");
            $query->execute();
            return $query->fetchAll();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function find_role($id) {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM roles WHERE `id`=:id");
            $query->execute(array('id'=>$id));
            return $query->fetchAll();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


}