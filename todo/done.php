<?php 

include "dbconnect.php";
$id = $_POST["task_id"];
$status = 1;

$sql = "UPDATE lists SET status=:status WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->bindParam(":status", $status);
$stmt->execute();
header("location: index.php");


?>