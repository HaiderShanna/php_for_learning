<?php 
include '../includes/dbh.php';
include '../model/database.php';
require ("../includes/session_security.php");
include ("../includes/print_posts.php");
if (isset($_SESSION['logged_in'])) {
    $username = $_SESSION['username'];

    if(isset($_GET['log_out'])){
        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
    }
    function check_error(){
        if(isset($_GET['no_file']) || isset($_GET['empty_caption']) || isset($_GET['long_caption'])){
            echo "post-page";
        }
        else{
            echo "post-page closed";
        }
    }
    function error_p(){
        if(isset($_GET['no_file'])){
            echo "<p class='error'>No File Selected !</p>";
        }
        elseif(isset($_GET['empty_caption'])){
            echo "<p class='error'>Write a Caption !</p>";
        }
        elseif(isset($_GET['long_caption'])){
            echo "<p class='error'>Caption is too long !</p>";
        }
    }

}
else{
    header("location: ../index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/home.css">
    <title>home</title>
</head>
<body>
    <div class="header">
        <div class="left-side">
            <i class="bi bi-instagram insta-logo"></i>
            <p>Instagram</p>
        </div>
        <div class="mid-side">
            <button class="add-post">Add a New Post <i class="bi bi-plus-square" style="padding-left: 5px;"></i></button>
        </div>
        <div class="right-side">
            <a href="home_page.php" class="link">Home</a>
            <a href="profile_page.php" class="link">My Profile</a>
            <a href="home_page.php?log_out" role="button" class="log-out">
                <i class="bi bi-box-arrow-left"></i>
                log out
            </a>
        </div>
    </div> 

    <ul class="friends-list">
        <li>
            <div>
                <img src="../imgs/profile_pictures/aliimg_2478.jpg" alt="test">
                <p>username</p>
            </div>
            <button>Follow</button>
        </li>
        <li>
            <div>
                <img src="" alt="test">
                <p>username</p>
            </div>
            <button>Follow</button>
        </li>
    </ul>

    <div class="<?php check_error() ?>">
        <form action="../includes/post_check.php" class="post-form" enctype="multipart/form-data" method="post">
            <div class="image-div">
                <label for="post-image" class="post-image-label">Choose Image</label>
                <input type="file" name="file" id="post-image" class="post-image" accept="image/*"/>
            </div>
            <div class="caption-div">
                <label for="post-caption" style="margin-bottom: 5px;">caption:</label>
                <textarea type="text" id="post-caption" name="post-caption" class="post-caption" rows="4" cols="50">
                
                </textarea>
            </div>
            <input type="submit" class="post" value="Post" />
            <?php error_p() ?>
        </form>
    </div>
    <?php printPosts() ?>

    <script>
        let postButton = document.querySelector(".add-post");
        let postDiv = document.querySelector(".post-page");
        postButton.addEventListener('click', ()=>{
            postDiv.classList.toggle('closed');
        })
    </script>  
</body>
</html>

