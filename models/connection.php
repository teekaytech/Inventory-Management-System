<?php

class Connection {

    public static function dbEngine(){
        $host = '127.0.0.1';
        $dbname = 'parach_ivms';
        $username = 'teekaytech';
        $password = 'password';
        $handle = false;
        try {
            $handle = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
            $handle->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo $e->getMessage();
        }
        return $handle;
    }

}