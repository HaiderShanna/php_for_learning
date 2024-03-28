<?php
class database extends dbh{
    private $pdo;
    public function __construct()
    {
        $dbh = new dbh("localhost", "root", "", "firstdb");
        $this->pdo = $dbh->connect();
    }
    protected function set_user($email, $username, $password){
        $query = "INSERT INTO users (email, name, password) 
        VALUES(:email, :name, :password); ";

        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $username);
        $stmt->bindParam(':password', $hashed_pass);
        $stmt->execute();
    }
    public function registered_email($email){
        $query = "SELECT email FROM users WHERE email = :email;";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function registered_username($username){
        $query = "SELECT name FROM users WHERE name = :username;";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function check_email_username($email_username){
        $query = "SELECT email FROM users WHERE email = :email OR name = :name";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email_username);
        $stmt->bindParam(':name', $email_username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function check_password($email_username, $password){
        $query = "SELECT password FROM users WHERE email = :email OR name = :name";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email_username);
        $stmt->bindParam(':name', $email_username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $result['password']))
            return true;
        else 
            return false;
    }
    public function update_token($token, $expiry, $email){
        $query = "UPDATE users
                  SET token = :token, token_expiry = :expiry
                  WHERE email = :email;";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiry', $expiry);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }
    public function check_token($token, $email){
        $query = "SELECT * FROM users WHERE email = :email";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(pdo::FETCH_ASSOC);
        if($result['token'] == $token){
            return true;
        }
        else 
            return false;

        
    }
    public function expired_token($hashed_token){
        $query = "SELECT token_expiry FROM users WHERE token = :token";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':token', $hashed_token);
        $stmt->execute();
        $result = $stmt->fetch(pdo::FETCH_ASSOC);
        if(strtotime($result['token_expiry']) + 43200 <= time()){
            return true;
        }
        else 
            return false; 
    }

    public function update_password($password, $email){
        $query = "UPDATE users
                  SET password = :password,
                      token = NULL,
                      token_expiry = NULL
                  WHERE email = :email;";

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }
    public function get_username($email_username){
        $query = "SELECT name FROM users WHERE email = :email OR name = :name";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email_username);
        $stmt->bindParam(':name', $email_username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_email($email_username){
        $query = "SELECT email FROM users WHERE email = :email OR name = :name";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email_username);
        $stmt->bindParam(':name', $email_username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_user_id($username){
        $query = "SELECT id FROM users WHERE name = :username";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];
        return $id;
    }
    public function get_profile_picture($email){
        $query = "SELECT profile_picture FROM users WHERE email = :email;";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['profile_picture'];
    }
    public function update_profile_picture($username, $filename){
        $query = "UPDATE users
                  SET profile_picture = :filename
                  WHERE name = :username";
                  
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }
    public function create_post($user_id, $post, $caption){
        $query = "INSERT INTO posts (user_id, post, caption)
                  VALUES(:user_id, :post, :caption);";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':post', $post);
        $stmt->bindParam(':caption', $caption);
        $stmt->execute();
    }
    public function get_all_posts(){
        $query = "SELECT users.name, users.profile_picture, post, caption, date FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY date DESC;";

        $result = $this->pdo->query($query);
        return $result->fetchAll(pdo::FETCH_ASSOC);
    }
    public function get_friends_posts($id){
        $query = "SELECT users.name, users.profile_picture, post, caption, date FROM posts
        JOIN users ON posts.user_id = users.id
        WHERE user_id IN(
            SELECT friend FROM friends
            WHERE user = $id
        ) OR user_id = $id
        ORDER BY date DESC;";

        $result = $this->pdo->query($query);
        return $result->fetchAll(pdo::FETCH_ASSOC);
    }
    public function get_id($username){
        $query = "SELECT id FROM users WHERE name = :name";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
    public function get_my_posts($id){
        $query = "SELECT users.name, users.profile_picture, post, caption, date FROM posts
        JOIN users ON posts.user_id = users.id
        WHERE user_id = :id
        ORDER BY date DESC;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(pdo::FETCH_ASSOC);
    }
    public function delete_post($post_name) {
        $query = "DELETE FROM posts WHERE post = '$post_name'";
        $this->pdo->query($query);
    }
    public function get_friends_list($limit, $id){
        $query2 = "SELECT name, profile_picture FROM users
        WHERE id NOT IN (
            SELECT friend FROM friends
            WHERE user = $id
            ) AND id != $id  
        LIMIT $limit;";


        $result = $this->pdo->query($query2);
        return $result->fetchAll(pdo::FETCH_ASSOC);
    }
    public function add_friend($user, $friend){
        $query = "INSERT INTO friends(user, friend)
                VALUES('$user', '$friend')";

        $this->pdo->query($query);
    }

}


