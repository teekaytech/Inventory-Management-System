<?php

class Connection {

    public static function dbEngine(){

        //dev config
//        $host = '127.0.0.1';
//        $dbname = 'parach_ivms';
//        $username = 'teekaytech';
//        $password = 'password';

        //live config
        $host = 'us-cdbr-east-02.cleardb.com';
        $dbname = 'heroku_d52161f13128ec0';
        $username = 'bae0cb0c42a922';
        $password = 'fa62454e';
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