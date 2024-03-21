<?php
class SignUp extends database{
    private $email;
    private $username;
    private $password;

    public function __construct($email, $username, $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
    public function empty_input(){
        if(empty($this->email) || empty($this->username) || empty($this->password))
            return true;
        else
            return false;
    }
    public function invalid_email(){
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            return true;
        else
            return false;
        
    }
    public function create_user(){
        $user = new database;
        $user->set_user($this->email, $this->username, $this->password);
    }
    public function used_email(){
        $user = new database;
        return $user->registered_email($this->email);
    }
    public function used_username(){
        $user = new database;
        return $user->registered_username($this->username);
    }
    public function user_username(){
        $user = new database;
        return $user->get_username($this->username);
    }
}
