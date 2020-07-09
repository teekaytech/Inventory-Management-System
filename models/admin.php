<?php
require_once '../models/connection.php';

class Admin {

    public static function admin_login($data) {
        $user = false;
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM admin WHERE username = :username");
            $query->execute(array(':username' =>$data['username']));
            $user = $query->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $user;
    }

    public static function fetch_admin($id) {
        $user = false;
        try {
            $query = Connection::dbEngine()->prepare("SELECT `firstname`, `lastname`, `middlename`, `email`,
                                                                `phone_no`, `role_id`, `status` FROM admin WHERE id = :id");
            $query->execute(array(':id' => $id));
            $user = $query->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $user;
    }



}