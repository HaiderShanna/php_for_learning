<?php
require_once 'dbh.php';
require_once '../model/database.php';
require_once 'session_security.php';
if (!isset($_SESSION['logged_in'])) {
    die();
}
if (!isset($_POST['post'])) {
    die();
}
$db = new database;
$post = $_POST['post'];
$id = $_SESSION['user_id'];
$post_id = $db->get_post_id($post);

if (isset($_POST['like'])) {
    $db->add_like($id, $post_id);
    echo $db->likes_num($post_id) . " Likes";
} else {
    $db->remove_like($id, $post_id);
    echo $db->likes_num($post_id) . " Likes";
}
