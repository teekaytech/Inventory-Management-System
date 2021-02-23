<?php
require_once '../models/connection.php';

class Course {

    public static function all_courses() {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM courses");
            $query->execute();
            return $query->fetchAll();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

}