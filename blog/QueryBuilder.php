<?php 
require "dbconnect.php";

function select($table, $cols, $conn){
    $sql = 'SELECT '.$cols.' FROM '.$table;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;

}


?>