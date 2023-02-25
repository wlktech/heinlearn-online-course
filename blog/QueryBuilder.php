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
function show($table, $cols, $join, $id, $conn){
    $sql = "SELECT $cols FROM $table";
    if($join != null){
        $sql .= " $join";
    }
    if($id != null){
        $sql .= " WHERE posts.id= $id";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function selectone($table, $cols, $id, $conn){
    $sql = 'SELECT '.$cols.' FROM '.$table.' WHERE id='.$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}

function edit($table, $id, $conn){
    $sql = "SELECT * FROM $table WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}

//sayar hein
// function update($table, $datas, $id, $conn){
//     $col_set = [];
//     foreach($datas as $key=>$value){
//         $col_set[] = "$key = :$key";
//     }
//     $col_bindData = implode(",", $col_set);
//     $sql = "UPDATE $table SET $col_bindData WHERE id = :id";
//     $stmt = $conn->prepare($sql);
//     foreach($datas as $key => &$value){
//         $stmt->bindParam(":".$key, $value);
//     }
//     $stmt->bindParam(":id", $id);
//     $stmt->execute();
// }

//update by WLK
function update($table, $datas, $id, $conn){
    $edits = "";
    foreach($datas as $key=>$value){ 
        $edits .= "$key=:$key,"; 
    }
    $edits = rtrim($edits, ',');
    $sql = "UPDATE $table SET $edits WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    foreach($datas as $key => &$value){
        $stmt->bindParam(":".$key, $value);
    }
    $stmt->execute();
    return true;
}



function delete($table, $id, $conn){
    $sql = 'DELETE FROM '.$table.' WHERE id='.$id;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return true;
}
?>