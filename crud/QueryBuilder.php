<?php 

class QueryBuilder{
    private $conn;
    public function __construct($connection){
        $this->conn = $connection;
    }

    //create
    public function create($table, $datas){
        $column_names = implode("," , array_keys($datas));
        $bind_values = implode(", :", array_keys($datas));
        $sql = "INSERT INTO $table($column_names) VALUES(:$bind_values)";

        $stmt = $this->conn->prepare($sql);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
    }

    //read 
    public function getAll($table, $cols){
        $sql = 'SELECT '.$cols.' FROM '.$table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //innerJoin
    public function getJoin($table1, $cols, $table2, $table1_id, $table2_id){
        $sql = "SELECT ".$cols." FROM ".$table1." INNER JOIN ".$table2." ON ".$table1.".".$table1_id."=".$table2.".".$table2_id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //update
    function selectJoins($table, $cols, $join, $where, $order){
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
    public function get($table, $cols, $id){
        $sql = 'SELECT '.$cols.' FROM '.$table.' WHERE id= :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function update($table, $datas, $edits, $id){
        $sql = "UPDATE $table SET $edits WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
    }

    //delete
    public function delete($table, $id){
        $sql = "DELETE FROM $table WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return true;
    }
}

?>