<?php 
include ("login_view.php");
$error = new Errors;
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
<form action="../includes/forgot_password.php" method="post" class="login-form">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="icon" role="img" style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png&quot;); background-position: 0px 0px; background-size: 176px 264px; width: 174px; height: 50px; background-repeat: no-repeat; display: inline-block;">
        </i>
        <p class="some-text">send a link to this email : </p>
        <input type="text" placeholder="email" name="email">
        <?php 
        $error->check_errors();
        if(isset($_GET['email_sent'])){
            echo '<p class="correct">link has been sent to your email ! </p>';
        }
        ?>
        <button type="submit" name="submit" class="login-button">Send</button>
    </form>
</body>
</html>