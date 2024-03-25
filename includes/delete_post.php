<?php
require_once 'dbh.php';
require_once '../model/database.php';
require_once 'session_security.php';

if(!isset($_SESSION['logged_in'])){
    header("location: ../index.php");
    die();
}
if(!isset($_POST['post_src'])){
    header("location: ../view/profile_page.php?error");
    die();
}

$db = new database;

$post_src = $_POST['post_src'];
$src_array = explode("/", $post_src);
$post_name = end($src_array);

unlink("../imgs/posts/$post_name");
$db->delete_post($post_name);
header("location: ../view/profile_page.php?success");
die();