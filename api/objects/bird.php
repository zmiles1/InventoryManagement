<?php
class Bird_type{

    // database connection and table name
    private $conn;
    private $table_name = "Bird_type";

    // object properties
    public $bird_type_id;
    public $bird_desc;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read farms
    public function read(){
        // call sql procedure to get query
        $query = "Select bird_type_id, bird_desc from Bird_type";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getBird(){
        $sql = "call selectBird();";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}
?>
