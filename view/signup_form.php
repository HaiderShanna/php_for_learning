<?php 
require ("signup_view.php");
$error = new Errors;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>instagram signup</title>
</head>
<body>
    <form action="../includes/signup.php" method="post" class="login-form">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="icon" role="img" style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png&quot;); background-position: 0px 0px; background-size: 176px 264px; width: 174px; height: 50px; background-repeat: no-repeat; display: inline-block;">
        </i>
        <p class="some-text">Sign up to see photos and videos from your friends.</p>
        <input type="text" placeholder="email" name="email">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <?php 
        $error->check_errors();
        ?>
        <button type="submit" name="submit" class="login-button">Sign up</button>
    </form>
    <div class="login-form">
        <p>Have an account? <a href="../index.php">Log in</a></p>
    </div>
</body>
</html>

