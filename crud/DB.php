<?php 

class DB{
    private $host = "localhost:3308";
    private $dbname = "todo";
    private $username = "root";
    private $password = "";
    private $conn;
    public function connect(){
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
        return $this->conn;
    }
}



?>