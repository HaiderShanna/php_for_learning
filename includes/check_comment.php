<?php
require_once 'dbh.php';
require_once '../model/database.php';
require_once 'session_security.php';

if (!isset($_SESSION['logged_in'])) {
    die();
}
$user_id = $_SESSION['user_id'];
$text = htmlspecialchars($_POST['text']);
if(empty(trim($text))){
    die();
}
$post = $_POST['post'];
$db = new database;
$post_id = $db->get_post_id($post);
$db->add_comment($user_id, $post_id, $text);
echo $db->comments_num($post_id) . " Comments";