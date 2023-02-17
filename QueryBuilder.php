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

        $stmt = $conn->prepare($sql);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
    }

    //read 
    public function getAll($table, $cols){
        $sql = 'SELECT '.$cols.' FROM '.$table;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //update
    public function get($table, $cols, $id){
        $sql = 'SELECT '.$cols.' FROM '.$table.' WHERE id='.$id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    //delete
    public function delete($table, $id){
        $sql = 'DELETE FROM '.$table.' WHERE id='.$id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return true;
    }
}

?>