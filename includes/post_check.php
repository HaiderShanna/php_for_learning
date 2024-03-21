<?php
include 'dbh.php';
include '../model/database.php';
include 'session_security.php';
if(!isset($_SESSION['logged_in'])){
    header("location: ../index.php");
    die();
}
if($_FILES['file']['name'] == ""){
    header("location: ../view/home_page.php?no_file");
    die();
}
$caption = htmlspecialchars($_POST['post-caption']);

if(trim($caption) == ""){
    header("location: ../view/home_page.php?empty_caption");
    die();
}elseif (strlen($caption) >= 255) {
    header("location: ../view/home_page.php?long_caption");
    die();
}



$file = $_FILES['file'];
$filename = $file['name'];
$tmpname = $file['tmp_name'];
$filenamearray = explode('.', $filename);
$fileEXT = strtolower(end($filenamearray));

$allowedEXT = ["jpg", "jpeg", "png"];

if(in_array($fileEXT, $allowedEXT)){
    $filename = uniqid('', true) . '.' .$fileEXT;
    move_uploaded_file($tmpname, "../imgs/posts/$filename");
    $db = new database;
    $userid = $db->get_user_id($_SESSION['username']);
    $db->create_post($userid, $filename, $caption);
    header("location: ../view/home_page.php?success");
    die();
}