<?php
include '../includes/dbh.php';
include '../model/database.php';
include '../includes/session_security.php';
require_once '../includes/print_posts.php';

if (!isset($_SESSION['logged_in'])) {
    header("location: ../index.php");
    die();
}

$db = new database;
$profile_picture = $db->get_profile_picture($_SESSION['email']);
$username = $_SESSION['username'];
$id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <link rel="stylesheet" href="../styles/posts.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>My Profile</title>
</head>

<body>
    <div class="header">
        <div class="left-side">
            <i class="bi bi-instagram insta-logo"></i>
            <p>Instagram</p>
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
    <section class="user-info">

        <div class="left-side">
            <div class="img-username">
                <img src="../imgs/profile_pictures/<?php echo $profile_picture ?>" alt="profile picture">
                <?php echo "<p class='username'>$username</p>" ?>
            </div>
            <form action="../includes/update_profile.php" method="post" enctype="multipart/form-data" class="myform">
                <label for="file" class="file-label">Update picture</label>
                <input type="file" accept="image/*" class="file" id="file" name="file" value="test">
            </form>
            <?php
            if (isset($_GET['invalid_image'])) {
                echo "<p class='error'>invalid image extention</p>";
            }
            ?>
        </div>

        <div class="user-numbers">
            <div>
                <p class="num-of-posts"><?php echo count($db->get_my_posts($id)) ?></p>
                <p>posts</p>
            </div>
            <div>
                <p><?php echo $db->get_followers_number($id) ?></p>
                <p>followers</p>
            </div>
            <div>
                <p><?php echo $db->get_following_number($id) ?></p>
                <p>following</p>
            </div>
        </div>

    </section>
    <div class="flex-div">
        <?php print_my_posts(); ?>
    </div>

    <?php
    if (isset($_GET['success'])) {
    ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Post Deleted Successfully",
                    showConfirmButton: false,
                    timer: 1500
                });
            })
        </script>
    <?php
    }
    ?>
    <script>
        let x = document.querySelector(".file");
        x.onchange = function() {
            document.querySelector(".myform").submit();
        }

        /* Delete Button */
        $(document).on('click', '.three-dots', function(e) {
            let delete_button = $(e.target).parent().find(".delete-button");
            $(delete_button).toggleClass("closed");
        })

        $(document).on('click', '.delete-button', function(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let post = $(e.target).data("post");
                    $.post("../includes/delete_post.php", {
                        post: post
                    }, function(data) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Post Deleted Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        let this_post = $(e.target).parent().parent().parent();
                        $(this_post).remove();
                        let current_num_of_posts = $(".num-of-posts").text();
                        current_num_of_posts = parseInt(current_num_of_posts) - 1;
                        $(".num-of-posts").html(current_num_of_posts);
                    })
                }
            });

        })
        /***************************/
    </script>
</body>

</html>