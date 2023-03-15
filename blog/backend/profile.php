<?php 
session_start();
// require "../dbconnect.php";
// require "../QueryBuilder.php";

// $id = $_GET['id'];
// $user = selectone("users", '*', $id, $conn); 

?>
<p>Name: <?= $_SESSION['name'] ?></p>
<p>Email: <?= $_SESSION['email'] ?></p>
<p>Role: <?php if($_SESSION['role']==1){ echo "Super Admin"; }else if($_SESSION['role']==2){ echo "Admin"; }  ?></p>

