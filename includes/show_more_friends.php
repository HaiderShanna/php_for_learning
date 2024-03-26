<?php
require_once 'session_security.php';
require_once 'print_friends_list.php';

if (!isset($_SESSION['logged_in'])){
    die();
}
$limit_count = $_POST['limit_count'];
print_friends_list($limit_count);