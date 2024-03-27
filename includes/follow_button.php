<?php 
require_once 'dbh.php';
require_once '../model/database.php';
require_once 'session_security.php';

if(!isset($_POST['username'])){
    echo "error";
    die();
}
$db =  new database;
$user =  $_SESSION['user_id'];
$username = $_POST['username'];
$friend = $db->get_id($username);

$db->add_friend($user, $friend);