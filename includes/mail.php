<?php
 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
//required files
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
 


$mail = new PHPMailer(true);

//Server settings
$mail->isSMTP();                              //Send using SMTP
$mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
$mail->SMTPAuth   = true;             //Enable SMTP authentication
$mail->Username   = 'haidershanna@gmail.com';   //SMTP write your email
$mail->Password   = 'jlclrrlibiewltdu';      //SMTP password
$mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
$mail->Port       = 465;                                    


