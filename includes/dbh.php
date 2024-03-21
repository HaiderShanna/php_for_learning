<?php
class dbh{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
    protected function connect(){
        try {
            $pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}