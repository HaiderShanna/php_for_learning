<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    require ("dbh.php");
    require ("../model/database.php");
    require ("../controller/login_cntr.php");
    include("session_security.php");

    $user = new login($username_email, $password);
    $db = new database;

    if($user->empty_input())
        header('location: ../index.php?empty_input=true');
    elseif (!$user->registered()){
        header('location: ../index.php?incorrect_username_email=true');
    }
    elseif (!$user->correct_password()){
        header('location: ../index.php?incorrect_password=true');
    }
    else{
        $username = $user->user_username()['name'];
        $email = $user->user_email()['email'];
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $db->get_id($username);
        header("location: ../view/home_page.php");
    }
}
else{
    header('location: ../index.php');
    die();
}