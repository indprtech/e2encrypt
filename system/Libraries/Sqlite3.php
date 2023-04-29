<?php
include(__DIR__ . "/../SqliteCore.php");
class Sqlite3Database extends SqliteCore{

    function __construct(){
        $this->open($this->core()->loadConfig()->sqlite_db);
    }

    public function list($query){
        $data = array();
        $qB = $this->query($query);
        while($row = $qB->fetchArray(SQLITE3_ASSOC) ) {
            $data[] = $row;
        }
        return $data;
    }

    public function add($table,$data){
        $query = "INSERT INTO `$table` (";
        $fields = "";
        $values = "";

        foreach ($data as $field => $value) {
            $fields .= "$field, ";
            $values .= "'" .$value. "', ";
        }

        $fields = rtrim($fields, ", ");
        $values = rtrim($values, ", ");

        $query .= "$fields) VALUES ($values)";

        try{
            $this->query($query);
            return [
                'STATE' => TRUE,
                'MESSAGE' => "Successfully added",
                'INSERT_ID' => $this->lastInsertRowID()
            ];
        }catch(Exception $e){
            return [
                'STATE' => FALSE,
                'MESSAGE' => "Cannot add row"
            ];
            $this->core()->showError($e->getMessage());
        }
    }

    public function edit($table,$array,$data){
        $query = "UPDATE `$table` SET ";
        foreach ($data as $field => $value) {
            $query .= "`$field` = '" . $value. "', ";
        }

        $query = rtrim($query, ", ");
        $query .= " WHERE ".$array['row']." = '".$array['id']."';";

        try{
            $queryExec = $this->query($query);
        }catch(Exception $e){
            $queryExec = FALSE;
            $this->showError($e->getMessage());
        }

        if($queryExec){
            return [
                'STATE' => TRUE,
                'MESSAGE' => "Successfully edited",
            ];
        }else{
            return [
                'STATE' => FALSE,
                'MESSAGE' => "Cannot edit row"
            ];
        }
    }

    public function delete($table,$row,$id,$ids = null){
        if($ids !== null){
            //Delete in Bulk
            foreach($ids as $newId){
                $this->query("DELETE FROM $table WHERE $row = '$newId';");
            }
        }else{
            $this->query("DELETE FROM $table WHERE $row = '$id';");
        }

        return [
            'STATE' => TRUE,
            'MESSAGE' => "Deleted Successfully"
        ];
    }
}