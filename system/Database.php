<?php
class Database extends Core{

    public $dbConfig = [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'dbase' => 'test'
    ];

    public $db = null;

    public function __construct($initConfig = true , $additonalConfig = false){
        if($this->isNull($initConfig) == false){
            $this->dbConfig = $this->loadConfig()->database;
            $this->db = mysqli_connect($this->dbConfig['host'], $this->dbConfig['user'], $this->dbConfig['pass'] , $this->dbConfig['dbase']);

            if (!$this->db) {
                $this->showError("<h5>Database Error</h5> " . mysqli_connect_error());
            }
        }else{
            $this->showError("Null Value Parsed Through Database()");
        }
    }

    public function list($query){
        $result = mysqli_query($this->db, $query);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $data[] = $row;
            }
        }
        return $data;
    }

    public function add($table,$data){
        $query = "INSERT INTO `$table` (";
        $fields = "";
        $values = "";

        foreach ($data as $field => $value) {
            $fields .= "`$field`, ";
            $values .= "'" . mysqli_real_escape_string($this->db,$value) . "', ";
        }

        $fields = rtrim($fields, ", ");
        $values = rtrim($values, ", ");

        $query .= "$fields) VALUES ($values)";
        try{
            $queryExec = mysqli_query($this->db,$query);
        }catch(Exception $e){
            $queryExec = FALSE;
            $this->showError($e->getMessage());
        }
        
        if($queryExec){
            return [
                'STATE' => TRUE,
                'MESSAGE' => "Successfully added",
                'INSERT_ID' => $this->db->insert_id
            ];
        }else{
            return [
                'STATE' => FALSE,
                'MESSAGE' => "Cannot add row"
            ];
        }
    }

    public function edit($table,$id,$data){
        $query = "UPDATE `$table` SET ";
        foreach ($data as $field => $value) {
            $query .= "`$field` = '" . mysqli_real_escape_string($this->db, $value) . "', ";
        }

        $query = rtrim($query, ", ");
        $query .= " WHERE id = '$id';";

        try{
            $queryExec = mysqli_query($this->db,$query);
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
                mysqli_query($this->db,"DELETE FROM `$table` WHERE `$table`.`$row` = $newId");
            }
        }else{
            mysqli_query($this->db,"DELETE FROM `$table` WHERE `$table`.`$row` = $id");
        }

        return [
            'STATE' => TRUE,
            'MESSAGE' => "Deleted Successfully"
        ];
    }
}