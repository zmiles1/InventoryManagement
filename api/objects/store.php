<?php
class Store{

    // database connection and table name
    private $conn;
    private $table_name = "Store";

    // object properties
    public $store_name;
    public $manager_name;
    public $store_phone;
    public $store_address;
    public $store_city;
    public $store_zip;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read farms
    public function read(){
        // call sql procedure to get query
        $query = "Select * From Store;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create new farm
    public function create(){
        // call sql procedure to add new farm
        $store_name = $this->store_name;
		$store_phone = $this->store_phone;
        $store_address = $this->store_address;
        $store_city = $this->store_city;
		$store_zip = $this->store_zip;
        $store_state = $this->store_state;
        $sql = "INSERT INTO chickens.Store(store_name,store_phone,store_address, store_zip, store_city, store_state, active) VALUES ('$store_name','$store_phone','$store_address', '$store_zip', '$store_city', '$store_state', '1');";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
    }
        public function deactivateStore(){
        $store_id = $this->store_id;
        $sql = "Update chickens.Store SET active = 0 where store_id = $store_id;";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
    }

    public function readOne(){
        // query to read one farm
        $query = "SELECT * FROM " . $this->table_name . " WHERE farm_id = ? LIMIT 0,1";


        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind farm_id of farm to be updated
        $stmt->bindParam(1, $this->farm_id);

        // execute query
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->farm_id = $row['farm_id'];
        $this->farm_name = $row['farm_name'];
        $this->farm_address = $row['farm_address'];
        $this->farm_city = $row['farm_city'];
    }
}
?>