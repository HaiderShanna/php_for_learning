<?php
class Errors{
    public function check_errors(){
        if(isset($_GET['empty_input'])){
            echo '<p class="errors"> Fill in all fields ! </p>';
        }
        elseif (isset($_GET['incorrect_username_email'])) {
            echo '<p class="errors"> Incorrect username or email ! </p>';
        }
        elseif (isset($_GET['incorrect_password'])) {
            echo '<p class="errors"> Incorrect password ! </p>';
        }
        elseif (isset($_GET['expired_token'])) {
            echo '<p class="errors"> Expired token , try again ! </p>';
        }
        elseif (isset($_GET['password_reset'])) {
            echo '<p class="correct"> password reset successfully ! </p>';
        }
    }
}