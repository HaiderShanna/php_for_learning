<?php
require_once 'dbh.php';
require_once '../model/database.php';

if (!isset($_SESSION['logged_in'])){
    header("location: ../index.php");
    die();
}
function print_friends_list($limit){
    $db = new database;
    $id = $_SESSION['user_id'];
    $friends = $db->get_friends_list($limit, $id);
    if(count($friends) < $limit){
        echo "<p hidden></p>";
        foreach ($friends as $friend) {
            $name = $friend['name'];
            $profile_picture = $friend['profile_picture'];
            echo "
            <li>
                <div>
                    <img src='../imgs/profile_pictures/$profile_picture' alt='test'>
                    <p class='friend-name'>$name</p>
                </div>
                <button class='follow-button' data-name=$name>Follow</button>
            </li>
            ";
        }  
    } else{
        foreach ($friends as $friend) {
            $name = $friend['name'];
            $profile_picture = $friend['profile_picture'];
            echo "
            <li>
                <div>
                    <img src='../imgs/profile_pictures/$profile_picture' alt='test'>
                    <p class='friend-name'>$name</p>
                </div>
                <button class='follow-button' data-name=$name>Follow</button>
            </li>
            ";
        }  
    }
     
}