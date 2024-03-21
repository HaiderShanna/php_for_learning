<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once ("dbh.php");
    require_once ("../model/database.php");
    require ("../controller/signup_cntr.php");
    include("session_security.php");

    $user = new SignUp($email, $username, $password);
    $db = new database;


    if($user->empty_input())
        header('location: ../view/signup_form.php?empty_input=true');
    elseif ($user->invalid_email()) {
        header('location: ../view/signup_form.php?invalid_email=true');
    }
    elseif ($user->used_email()){
        header('location: ../view/signup_form.php?used_email=true');
    }
    elseif ($user->used_username()){
        header('location: ../view/signup_form.php?used_username=true');
    }
    else{
        $user->create_user();
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $db->get_id($username);
        header("location: ../view/home_page.php");
    }

}
else{
    header('location: signup_form.php');
    die();
}

