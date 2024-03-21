<?php
require ("session_security.php");
require ("../includes/dbh.php");
require ("../model/database.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];

    if(empty($password) || empty($confirm_password)){
        header("location: ../view/reset_password_form.php?token=$token&empty_input=true");
    }
    elseif ($password != $confirm_password) {
        header("location: ../view/reset_password_form.php?token=$token&incorrect_password=true");
    }
    else{
        $database = new database;
        $email = $_SESSION['email'];
        $database->update_password($password, $email);
        header("location: ../index.php?password_reset=success");
    }


}
else{
    header('location: ../index.php');
    die();
}