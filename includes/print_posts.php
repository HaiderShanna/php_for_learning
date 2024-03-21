<?php 
require_once 'session_security.php';

if(!isset($_SESSION['logged_in'])){
    header("location: ../index.php");
    die();
}
function printPosts() {
    $db = new database;
    $all_posts = $db->get_all_posts();
    
    foreach ($all_posts as $row) {
        $name = $row['name'];
        $profile_picture = $row['profile_picture'];
        $post = $row['post'];
        $caption = $row['caption'];
        $date = $row['date'];

        echo 
        "<div class='single-post'>
            <div class='post-head'>
                <img src='../imgs/profile_pictures/$profile_picture' alt='profile picture' class='post-profile-picture'>
                <p class='post-username'>$name</p>
            </div>
            <img src='../imgs/posts/$post' alt='post image' class='post'>
            <div class='post-bottom-div'>
                <p class='post-caption'>$caption</p>
                <p class='post-date'>$date</p>
            </div>
        </div>";
    }
}
function print_my_posts(){
    $id = $_SESSION['user_id'];
    $db = new database;
    $my_posts = $db->get_my_posts($id);
    
    foreach ($my_posts as $row) {
        $name = $row['name'];
        $profile_picture = $row['profile_picture'];
        $post = $row['post'];
        $caption = $row['caption'];
        $date = $row['date'];

        echo 
        "<div class='single-post'>
            <div class='post-head'>
                <img src='../imgs/profile_pictures/$profile_picture' alt='profile picture' class='post-profile-picture'>
                <p class='post-username'>$name</p>
            </div>
            <img src='../imgs/posts/$post' alt='post image' class='post'>
            <div class='post-bottom-div'>
                <p class='post-caption'>$caption</p>
                <p class='post-date'>$date</p>
            </div>
        </div>";
    }
}
