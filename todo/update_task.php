<?php 

include "dbconnect.php";
$id = $_POST["task_id"];
$task = $_POST["task"];

$sql = "UPDATE lists SET task=:task WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->bindParam(":task", $task);
$stmt->execute();
header("location: index.php");


?>