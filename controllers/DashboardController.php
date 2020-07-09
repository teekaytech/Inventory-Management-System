<?php

class DashboardController {

    public $admin;

    public function __construct(){
        if (!isset($_SESSION['admin_id'])) {
            $_SESSION['info'] = "Please, login to continue...";
            header('location: ../index.php');
        }
        $this->admin = Admin::fetch_admin($_SESSION['admin_id']);
    }

    public function getAdmin() {
        return $this->admin;
    }
}