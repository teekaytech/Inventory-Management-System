<?php
require_once '../models/connection.php';
date_default_timezone_set('Africa/Lagos');

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
                                                                 `end_date`, `channel_id`, `admin_id`, `created_at`)
                                                                 VALUES (:fname, :mname, :lname, :addr, :mail, :phone,
                                                                 :course_id, :s_date, :e_date, :channel_id, :admin_id, :cdate)");
            $query->execute(array(':fname' => $data['firstname'], ':mname' => $data['middlename'],
                            ':lname' => $data['lastname'], ':addr' => $data['address'], ':mail' => $data['email'],
                            ':phone' => $data['phone_no'], ':course_id' => $data['course_id'],
                            ':s_date' => $data['start_date'], ':e_date' => $data['end_date'],
                            ':channel_id' => $data['channel_id'], ':admin_id' => $id, ':cdate' => date("Y-m-d")));
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

    public static function fetch_all_students($start_date, $end_date) {
        $students = false;
        try {
            $query = Connection::dbEngine()->prepare("SELECT students.`created_at`, students.`start_date`, 
                students.`end_date`, students.`firstname`, students.`middlename`, students.`lastname`, students.`address`,
                students.`email`, students.`phone_no`, channels.`channel` as channel, courses.`name` as course
                FROM students
                    INNER JOIN channels ON students.`channel_id` = channels.`id`
                    INNER JOIN courses ON students.`course_id`  = courses.`id`
                WHERE students.`created_at` >= :start_date && students.`created_at` <=:end_date");
            $query->execute(array('start_date'=>$start_date, 'end_date'=>$end_date));
            $students = $query->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $students;
    }
}