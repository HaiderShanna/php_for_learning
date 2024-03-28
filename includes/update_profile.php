<?php
include 'dbh.php';
include '../model/database.php';
include 'session_security.php';

if(!isset($_SESSION['logged_in'])){
    header("location: ../index.php");
}

$file = $_FILES['file'];
$username = $_SESSION['username'];
$filename = $username . $file['name'];
$tmp_name = $file['tmp_name'];
$fileEXT = explode(".", $file['name'] );
$allowedEXT = ["jpg", "jpeg", "png"];
$EXT = strtolower(end($fileEXT));

if(in_array($EXT, $allowedEXT)){
    $filename = strtolower($filename);
    move_uploaded_file($tmp_name, "../imgs/profile_pictures/$filename");
    $db = new database;
    $db->update_profile_picture($username, $filename);
    header("location: ../view/profile_page.php");
    die();
}
else{
    header("location: ../view/profile_page.php?invalid_image");
    die();
}
    