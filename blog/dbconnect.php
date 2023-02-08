<?php 

try{
    $server_name="localhost:3308";
    $dbname = "blog_db";
    $dbuser = "root";
    $dbpassword = "";

    $dsn = "mysql:host=$server_name;dbname=$dbname";

    $conn = new PDO($dsn, $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Success";

}catch(PDOException $e){
    die ("connection fail: ". $e->getMessage());
}
    





?>