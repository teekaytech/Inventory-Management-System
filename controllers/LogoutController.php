<?php
@session_start();

if((isset($_SESSION['info'])) || (isset($_SESSION['admin_id']))){
    unset($_SESSION['admin_id']);
    unset($_SESSION['info']);
    unset($_SESSION['success']);
    unset($_SESSION['warning']);
    unset($_SESSION['error']);
    session_destroy();
    $url = "../index.php";
    header("Location:$url");
}
