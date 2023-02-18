<?php 
include "../DB.php";
include "../QueryBuilder.php";

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $datas = [
        "name" => $name,
        "email" => $email,
        "password" => $password
    ];
    $edits = "";
    foreach($datas as $key=>$value){
        // $edit .= $key.'=:'.$key; 
        $edits .= "$key=:$key,"; 
    }
    $edits = rtrim($edits, ',');
    

    if($_POST['action']=="add"){
        $status = $query->create("users", $datas);
        header("location: ../user/users.php");
    }else if($_POST['action']=="update"){
        $id = $_POST['id'];
        $status = $query->update("users", $datas, $edits, $id);
        header("location: ../user/users.php");
    }
    
}
if($_GET['action']=="delete"){
    $id = $_GET['id'];
    $status = $query->delete("users", $id);
    header("location: ../user/users.php");
}


?>