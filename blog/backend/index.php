<?php 
session_start();
if(isset($_SESSION['user_id'])){
    include "header.php";
    include "nav.php";
    include "dashboard.php";
    include "footer.php";

}else{
    header("location: login.php");
}


?>