<?php
class Building{

    // database connection and table name
    private $conn;
    private $table_name = "Building";

    // object properties
    public $building_id;
    public $building_number;
    public $building_floor;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read farms
    public function read(){
        // call sql procedure to get query
        $query = "SELECT * FROM Building";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}
?>
