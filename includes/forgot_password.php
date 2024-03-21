<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];

    require ("dbh.php");
    require ("../model/database.php");
    require ("../controller/login_cntr.php");
    require ("mail.php");
    require ("session_security.php");

    $user = new database;

    if(empty($email)){
        header('location: ../view/forgot_password_form.php?empty_input=true');
    }
    elseif (!$user->registered_email($email)) {
        header('location: ../view/forgot_password_form.php?incorrect_username_email=true');
    }
    else{
        
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry_date = date("y-m-d h:i:s", time() + 60 * 30);

        $user->update_token($token_hash, $expiry_date, $email);

        //Recipients
        $mail->setFrom("fuckingtest@gmail.com"); // Sender Email and name
        $mail->addAddress($email);     //Add a recipient email  

        //Content
        $mail->isHTML(true);               //Set email format to HTML
        $mail->Subject = "Reset your password";   // email subject headings
        $mail->Body    = "click <a href='http://localhost/instagram_clone_project/view/reset_password_form.php?token=$token'>here</a>"; //email message
        $_SESSION['email'] = $email;

        // Success sent message alert
        try {
            $mail->send();
            header('location: ../view/forgot_password_form.php?email_sent=true');

        } catch (Exception $e) {
            echo "failed to send the email : " . $mail->ErrorInfo;
        }
        
    }
}
else{
    header('location: ../view/forgot_password_form.php');
    die();
}
