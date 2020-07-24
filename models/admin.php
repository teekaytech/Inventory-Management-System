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
                                                                `phone_no`, `role_id`, `status`, `username`, `password`
                                                                FROM admin WHERE id = :id");
            $query->execute(array(':id' => $id));
            $user = $query->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $user;
    }

    public static function update_profile($data, $id) {
        try {
            if (isset($data['password'])){
                $query = Connection::dbEngine()->prepare("UPDATE admin SET `firstname`=:fname, `lastname`=:lname,
                                                                `middlename`=:mname, `email`=:email, `phone_no`=:phone_no,
                                                                `password`=:pswd WHERE id=:id");
                $query->execute(array('fname' => $data['firstname'], 'lname' => $data['lastname'], 'mname' => $data['middlename'],
                    'email' => $data['email'], 'phone_no'=>$data['phone_no'], 'pswd' => $data['password'],
                    'id' => $id));
            } else {
                $query = Connection::dbEngine()->prepare("UPDATE admin SET `firstname`=:fname, `lastname`=:lname,
                                                                `middlename`=:mname, `email`=:email, `phone_no`=:phone_no
                                                                WHERE id=:id");
                $query->execute(array('fname' => $data['firstname'], 'lname' => $data['lastname'], 'mname' => $data['middlename'],
                    'email' => $data['email'], 'phone_no'=>$data['phone_no'], 'id' => $id));
            }
            return true;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}