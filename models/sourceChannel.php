<?php
require_once '../models/connection.php';

class SourceChannel {

    public static function all_courses() {
        try {
            $query = Connection::dbEngine()->prepare("SELECT * FROM channels");
            $query->execute();
            return $query->fetchAll();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

}