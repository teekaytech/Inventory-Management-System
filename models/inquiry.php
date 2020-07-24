<?php
require_once '../models/connection.php';

class Inquiry {

    public static function all_enquiries() {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM inquiries");
            $query->execute();
            return $query->fetchAll();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function create_enquiry($data, $id) {
        try {
            $query = Connection::dbEngine()->prepare("INSERT INTO inquiries (`date`, `name`, `address`, 
                                                                `email`, `phone_no`, `course_id`, `channel_id`, `admin_id`)
                                                                 VALUES (:dt, :nm, :addr, :mail, :phone, :id, :details,
                                                                 :admin_id)");
            $query->execute(array(':dt' => $data['date'], ':nm' => $data['name'], ':addr' => $data['address'],
                            ':mail' => $data['email'], ':phone' => $data['phone_no'], ':id' => $data['course_id'],
                            'details' => $data['channel_id'], ':admin_id' => $id));
            return true;
        } catch(PDOException $e) { echo $e->getMessage();	}
    }

    public static function find_inquiry($email) {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM inquiries WHERE `email`=:email");
            $query->execute(array('email'=>$email));
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


}