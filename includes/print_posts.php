<?php
require_once 'session_security.php';

if (!isset($_SESSION['logged_in'])) {
    header("location: ../index.php");
    die();
}
function printPosts($limit)
{
    $id = $_SESSION['user_id'];
    $db = new database;
    $friends_posts = $db->get_friends_posts($id, $limit);
    if (count($friends_posts) < $limit) {
        post_template($friends_posts, $db, $id);
    } else {
        post_template($friends_posts, $db, $id);
        echo "<button class='show-more-posts'>Show More Posts</button>";
    }
}
function print_my_posts()
{
    $id = $_SESSION['user_id'];
    $db = new database;
    $my_posts = $db->get_my_posts($id);

    post_template($my_posts, $db, $id);
}

function post_template($friends_posts, $db, $id)
{
    foreach ($friends_posts as $row) {
        $name = $row['name'];
        $profile_picture = $row['profile_picture'];
        $post = $row['post'];
        $caption = $row['caption'];
        $date = $row['date'];
        $post_id = $db->get_post_id($post);
        $liked = $db->check_like($id, $post_id);
        $likes_num = $db->likes_num($post_id);
        echo
        "<div class='single-post'>";
        if ($db->is_my_post($id, $post_id)) {
            echo "
            <div class='my-post-head'>
                <div class='left-side'>
                    <img src='../imgs/profile_pictures/$profile_picture' alt='profile picture' class='post-profile-picture'>
                    <p class='post-username'>$name</p>
                </div>
                <div class='right-side'>
                    <button class='delete-button closed' data-post='$post'>Delete Post</button>
                    <i class='bi bi-three-dots-vertical three-dots'></i>
                </div>
            ";
        } else {
            echo "
                <div class='post-head'>
                    <img src='../imgs/profile_pictures/$profile_picture' alt='profile picture' class='post-profile-picture'>
                    <p class='post-username'>$name</p>";
        }
        echo "
                </div> 
                <img src='../imgs/posts/$post' alt='post image' class='post'>
                <div class='post-bottom-div'>
                    <div class='likes-comments'>
                        <div class='likes'>";
        if ($liked) {
            echo "<i class='bi bi-heart-fill' data-post='$post'></i>";
        } else {
            echo "<i class='bi bi-heart' data-post='$post'></i>";
        }
        echo
        "<p class='likes-num'>$likes_num Likes</p>
                        </div>
                        <div class='comments'>
                            <i class='bi bi-chat'></i>
                            <p>000 Comments</p>
                        </div>
                    </div>
                    <hr>
                    <div class='caption-date'>
                        <p class='post-caption'>$caption</p>
                        <p class='post-date'>$date</p>
                    </div>
                </div>
            </div>";
    }
}
