<?php
require_once '../models/connection.php';

class Student {

    public static function all_students() {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM students");
            $query->execute();
            return $query->fetchAll();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function create_student($data, $id) {
        try {
            $query = Connection::dbEngine()->prepare("INSERT INTO students (`firstname`, `middlename`, `lastname`, 
                                                                `address`, `email`, `phone_no`, `course_id`, `start_date`,
                                                                 `end_date`, `channel_id`, `admin_id`)
                                                                 VALUES (:fname, :mname, :lname, :addr, :mail, :phone,
                                                                 :course_id, :s_date, :e_date, :channel_id, :admin_id)");
            $query->execute(array(':fname' => $data['firstname'], ':mname' => $data['middlename'],
                            ':lname' => $data['lastname'], ':addr' => $data['address'], ':mail' => $data['email'],
                            ':phone' => $data['phone_no'], ':course_id' => $data['course_id'],
                            ':s_date' => $data['start_date'], ':e_date' => $data['end_date'],
                            ':channel_id' => $data['channel_id'], ':admin_id' => $id));
            return true;
        } catch(PDOException $e) { echo $e->getMessage();	}
    }

    public static function find_student($email) {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM students WHERE `email`=:email");
            $query->execute(array('email'=>$email));
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


}