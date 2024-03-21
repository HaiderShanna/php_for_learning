<?php
class login extends database{

    private $username_email;
    private $password;

    public function __construct($username_email, $password)
    {
        $this->username_email = $username_email;
        $this->password = $password;
    }
    public function empty_input(){
        if(empty($this->username_email) || empty($this->password))
            return true;
        else
            return false;
    }
    public function registered(){
        $user = new database;
        return $user->check_email_username($this->username_email);
    }
    public function correct_password(){
        $user = new database;
        return $user->check_password($this->username_email, $this->password);
    }
    public function user_username(){
        $user = new database;
        return $user->get_username($this->username_email);
    }
    public function user_email(){
        $user = new database;
        return $user->get_email($this->username_email);
    }
}