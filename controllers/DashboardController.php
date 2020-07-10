<?php
@session_start();
require_once '../models/admin.php';

class DashboardController {

    public $admin;

    public function __construct(){
        if (!isset($_SESSION['admin_id'])) {
            header('location: ../index.php');
        }
        $this->admin = Admin::fetch_admin($_SESSION['admin_id']);
    }

    public function check_login($data) {
        return Admin::admin_login($data);
    }
    public function getAdmin() {
        return $this->admin;
    }

    public function filter_data($request) {
        $values = [];
        foreach ($request as $k => $v) {
            array_push($values, $v);
        }
        return $values;
    }
}