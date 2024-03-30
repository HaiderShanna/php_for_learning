<?php
require_once 'dbh.php';
require_once '../model/database.php';
require_once 'session_security.php';

if(!isset($_SESSION['logged_in'])){
    die();
}
if(!isset($_POST['post'])){
    die();
}

$db = new database;
$post = $_POST['post'];


unlink("../imgs/posts/$post");
$db->delete_post($post);
die();