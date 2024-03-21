<?php
include '../includes/dbh.php';
include '../model/database.php';
include '../includes/session_security.php';
require_once '../includes/print_posts.php';

if(!isset($_SESSION['logged_in'])){
    header("location: ../index.php");
    die();
}
$db = new database;
$profile_picture = $db->get_profile_picture($_SESSION['email']);
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/profile.css">
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
            <img src="../imgs/profile_pictures/<?php echo $profile_picture ?>" alt="profile picture">
            <form action="../includes/update_profile.php" method="post" enctype="multipart/form-data"   class="myform">
                <label for="file" class="file-label">Update picture</label>
                <input type="file" accept="image/*" class="file" id="file" name="file" value="test">
            </form>
            <?php
            if(isset($_GET['invalid_image'])){
                echo "<p class='error'>invalid image extention</p>";
            }
            ?>
        </div>
        <div class="right-side">
            <?php  echo "<p class='username'>$username</p>" ?>
        </div>
    </section>
    <div class="flex-div">
        <?php print_my_posts(); ?> 
    </div>
    <script>
        let x = document.querySelector(".file");
        x.onchange = function () {
            document.querySelector(".myform").submit();
        }
    </script>
</body>
</html>