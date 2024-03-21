<?php 
require ("../includes/dbh.php");
require ("../model/database.php");
include ("login_view.php");
require ("../includes/session_security.php");

$token = $_GET['token'];
$hashed_token = hash("sha256", $token);

$database = new database;
$error = new Errors;

$email = $_SESSION['email'];
if(!$database->check_token($hashed_token, $email)){
    header('location: ../index.php');
}
elseif($database->expired_token($hashed_token)){
    header('location: forgot_password_form.php?expired_token=true');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>forgot password</title>
</head>
<body>
    <form action="../includes/reset_password_process.php" method="post" class="login-form">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="icon" role="img" style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png&quot;); background-position: 0px 0px; background-size: 176px 264px; width: 174px; height: 50px; background-repeat: no-repeat; display: inline-block;">
        </i>
        <p class="some-text">Set a new password : </p>
        <input type="password" placeholder="new password: " name="password">
        <input type="password" placeholder="confirm password: " name="confirm_password">

        <?php 
        $error->check_errors();
        ?>
        <button type="submit" name="submit" class="login-button">Reset password</button>
    </form>
</body>
</html>