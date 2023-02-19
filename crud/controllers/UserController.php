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
    $image_arr = $_FILES['image'];

    //image stored
    if(isset($image_arr) && $image_arr['size']>0){
        $dir = "../upload/";
        $image = $dir.$image_arr['name'];
        $tmp_name = $image_arr['tmp_name'];
        move_uploaded_file($tmp_name, $image);
    }

    
    
    

    if($_POST['action']=="uploadImage"){
        $datas = [
            "image" => $image
        ];
        $status = $query->create("users", $datas);
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else if($_POST['action']=="add"){
        $datas = [
            "name" => $name,
            "email" => $email,
            "password" => $password,
        ];
        $status = $query->create("users", $datas);
        header("location: ../user/users.php");
    }else if($_POST['action']=="update"){
        $datas = [
            "name" => $name,
            "email" => $email,
            "password" => $password,
        ];
        $edits = "";
        foreach($datas as $key=>$value){
            // $edit .= $key.'=:'.$key; 
            $edits .= "$key=:$key,"; 
        }
        $edits = rtrim($edits, ',');
        $id = $_POST['id'];
        $status = $query->update("users", $datas, $edits, $id);
        header("location: ../user/users.php");
    }
    
}
// if($_GET['action']=="delete"){
//     $id = $_GET['id'];
//     $status = $query->delete("users", $id);
//     header("location: ../user/users.php");
// }


?>