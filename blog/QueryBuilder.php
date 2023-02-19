<?php 
require "dbconnect.php";


function store($table, $datas, $conn){
    $column_names = implode("," , array_keys($datas));
    $bind_values = implode(", :", array_keys($datas));
    $sql = "INSERT INTO $table($column_names) VALUES(:$bind_values)";

    $stmt = $conn->prepare($sql);
    foreach($datas as $key => &$value){
        $stmt->bindParam(":".$key, $value);
    }
    $stmt->execute();

}


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
function selectJoins($table, $cols, $join, $where, $order, $conn){
    $sql = "SELECT $cols FROM $table";
    if($join != null){
        $sql .= " $join";
    }
    if($where != null){
        $sql .= " WHERE $where";
    }
    if($order != null){
        $sql .= " ORDER BY $order";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;

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