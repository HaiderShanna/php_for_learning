
<?php
class Errors{
    public function check_errors(){
        if(isset($_GET['empty_input'])){
            echo '<p class="errors"> Fill in all fields ! </p>';
        }
        elseif (isset($_GET['invalid_email'])) {
            echo '<p class="errors"> Invalid Email ! </p>';
        }
        elseif (isset($_GET['used_email'])) {
            echo '<p class="errors"> Email is already registered ! </p>';
        }
        elseif (isset($_GET['used_username'])) {
            echo '<p class="errors"> Username is taken ! </p>';
        }
    }
}
