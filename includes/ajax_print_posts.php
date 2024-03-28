<?php
require_once 'print_posts.php';
require_once 'dbh.php';
require_once '../model/database.php';

if(isset($_POST['limit'])){
    printPosts($_POST['limit']);
} else{
    printPosts(5);
}
