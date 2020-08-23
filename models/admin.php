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

    public static function all_admins() {
        try {
            $query = Connection::dbEngine()->prepare("SELECT `id`, `firstname`, `lastname`, `middlename`, `email`,
                                                                `phone_no`, `role_id`, `status`, `username` FROM admin
                                                                WHERE `delete_status`=:stat");
            $query->execute(array('stat'=>0));
            $query->execute();
            return $query->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function create_admin($data) {
        try {
            $query = Connection::dbEngine()->prepare("INSERT INTO admin (`username`, `password`, `role_id`)
                                                                 VALUES (:uname, :pswd, :r_id)");
            $query->execute(array(':uname' => $data['username'], ':pswd' => $data['password'], ':r_id' => $data['role_id']));
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function disable($id) {
        try {
            $query = Connection::dbEngine()->prepare("UPDATE admin SET status=:stts WHERE id=:a_id");;
            $query->execute(array('stts' => 2, 'a_id' => (int)$id));
            return true;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function enable($id) {
        try {
            $query = Connection::dbEngine()->prepare("UPDATE admin SET status=:stts WHERE id=:a_id");;
            $query->execute(array('stts' => 1, 'a_id' => (int)$id));
            return true;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function delete($id) {
        try {
            $query = Connection::dbEngine()->prepare("UPDATE admin SET delete_status=:ds, status=:s WHERE id=:a_id");;
            $query->execute(array('ds'=>1, 's'=>0, 'a_id'=>(int)$id));
            return true;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
