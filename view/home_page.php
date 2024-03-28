<?php
include '../includes/dbh.php';
include '../model/database.php';
require("../includes/session_security.php");
include("../includes/print_posts.php");
require_once '../includes/print_friends_list.php';

if (isset($_SESSION['logged_in'])) {
    $username = $_SESSION['username'];

    if (isset($_GET['log_out'])) {
        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
    }
    function check_error()
    {
        if (isset($_GET['no_file']) || isset($_GET['empty_caption']) || isset($_GET['long_caption'])) {
            echo "post-page";
        } else {
            echo "post-page closed";
        }
    }
    function error_p()
    {
        if (isset($_GET['no_file'])) {
            echo "<p class='error'>No File Selected !</p>";
        } elseif (isset($_GET['empty_caption'])) {
            echo "<p class='error'>Write a Caption !</p>";
        } elseif (isset($_GET['long_caption'])) {
            echo "<p class='error'>Caption is too long !</p>";
        }
    }
} else {
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <div class="friends-list-div">
            <?php print_friends_list(5); // 5 is the limit of users 
            ?>
        </div>
        <button class="show-more-button">Show more</button>
    </ul>

    <div class="<?php check_error() ?>">
        <form action="../includes/post_check.php" class="post-form" enctype="multipart/form-data" method="post">
            <div class="image-div">
                <label for="post-image" class="post-image-label">Choose Image</label>
                <input type="file" name="file" id="post-image" class="post-image" accept="image/*" />
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
    <div class="all-posts">
        <?php printPosts(5) ?>
    </div>

    <script>
        let postButton = document.querySelector(".add-post");
        let postDiv = document.querySelector(".post-page");
        postButton.addEventListener('click', () => {
            postDiv.classList.toggle('closed');
        })

        /*Show more friends button*/
        let show_more = document.querySelector(".show-more-button");

        $(document).ready(function() {
            let limit_count = 5;
            $(".show-more-button").click(function() {
                limit_count += 5;
                $.post("../includes/show_more_friends.php", {
                    limit_count: limit_count
                }, function(data, status){
                    if(data.includes("<p hidden>")){
                        show_more.remove();
                    }
                    $(".friends-list-div").html(data);
                })
            })
        })

        /* Show more Posts button */
        let show_more_posts = document.querySelector(".show-more-posts");

        $(document).ready(function(){
            let limit = 5;
            $(document).on('click', '.show-more-posts', function(){
                $(".all-posts").load("../includes/ajax_print_posts.php", {limit: limit +=5});
            })
        })


        /* Follow Button */
        $(document).ready(function() {

            $(document).on('click', '.follow-button', function(event) {
                let element = event.target;
                let username = $(element).data("name");
                if (element.innerHTML != "followed") {
                    $.post("../includes/follow_button.php", {
                            username: username
                        },
                        function(data, status) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Added friend",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            element.classList.add("followed");
                            element.innerHTML = "followed";
                            $(".all-posts").load("../includes/ajax_print_posts.php");
                        })
                }
            });
        })
    </script>
</body>

</html>