<?php 
require "dbconnect.php";

function select($table, $cols, $conn){
    $sql = 'SELECT '.$cols.' FROM '.$table;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;

}
function selectJoin($table1, $cols, $table2, $table1_id, $table2_id, $conn){
    $sql = "SELECT ".$cols." FROM ".$table1." INNER JOIN ".$table2." ON ".$table1.".".$table1_id."=".$table2.".".$table2_id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
function selectone($table, $cols, $id, $conn){
    $sql = 'SELECT '.$cols.' FROM '.$table.' WHERE id='.$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
function delete($table, $id, $conn){
    $sql = 'DELETE FROM '.$table.' WHERE id='.$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return true;
}
?>