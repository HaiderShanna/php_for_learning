<?php
require_once 'dbh.php';
require_once '../model/database.php';
require_once 'session_security.php';

if (!isset($_SESSION['logged_in'])) {
    die();
}
$post = $_POST['post'];
$user_id = $_SESSION['user_id'];
$db = new database;
$post_id = $db->get_post_id($post);

$all_comments = $db->get_all_comments($post_id);
if (empty($all_comments)) {
    echo "
    <div class='comments-section'>
        <div class='all-comments'>
            <div class='empty-section'>there are no comments !</div>
        </div>
        <div class='input-section'>
            <input type='text' class='comment-input' placeholder='enter your comment'>
            <button class='post-comment-button' data-post='$post'>Post</button>
        </div>
    </div>
    ";
} else {
    echo "
    <div class='comments-section'>
        <div class='all-comments'>";

    foreach ($all_comments as $comment) {
        $profile_picture = $comment['profile_picture'];
        $name = $comment['name'];
        $text = $comment['comment'];
        $date = $comment['date'];
        echo "
            <div class='single-comment'>
                
                <div class='user-info'>
                    <img src='../imgs/profile_pictures/$profile_picture'>
                    <p class='username'>$name</p>
                </div>
                <div class='comment-content'>
                    <p> $text </p>
                    <small> $date </small>
                </div>
            </div>";
    }
    echo "
        </div>
        <div class='input-section'>
            <input type='text' class='comment-input' placeholder='enter your comment'>
            <button class='post-comment-button' data-post='$post'>Post</button>
        </div>
    </div>
    ";
}
