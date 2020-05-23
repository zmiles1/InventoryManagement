<?php
class Farm{

    // database connection and table name
    private $conn;
    private $table_name = "Farm";

    // object properties
    public $farm_id;
    public $farm_name;
    public $farm_address;
    public $farm_city;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read farms
    public function read(){
        // call sql procedure to get query
        $query = "CALL getFarm()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create new farm
    public function create(){
        // call sql procedure to add new farm
        $query = "INSERT INTO
        " . $this->table_name . "
    SET
        farm_name=:farm_name, farm_address=:farm_address, farm_city=:farm_city";
        
        $stmt = $this->conn->prepare($query);
        
        // clean up inputs
        $this->farm_name=htmlspecialchars(strip_tags($this->farm_name));
        $this->farm_address=htmlspecialchars(strip_tags($this->farm_address));
        $this->farm_city=htmlspecialchars(strip_tags($this->farm_city));

        // bind values
        $stmt->bindParam(":farm_name", $this->farm_name);
        $stmt->bindParam(":farm_address", $this->farm_address);
        $stmt->bindParam(":farm_city", $this->farm_city);

        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
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

    //update farm
    function update(){
	$query = "UPDATE
		" . $this->table_name . "
		SET
		    farm_name=:farm_name,
		    farm_address=:farm_address,
                    farm_city=:farm_city
                WHERE
    		    farm_id=:farm_id";

       $stmt = $this->conn->prepare($query);

       $this->farm_name=htmlspecialchars(strip_tags($this->farm_name));
       $this->farm_address=htmlspecialchars(strip_tags($this->farm_address));
       $this->farm_city=htmlspecialchars(strip_tags($this->farm_city));
       $this->farm_id=htmlspecialchars(strip_tags($this->farm_id));

       $stmt->bindParam(':farm_name', $this->farm_name);
       $stmt->bindParam(':farm_city', $this->farm_city);
       $stmt->bindParam(':farm_address', $this->farm_address);
       $stmt->bindParam(':farm_id', $this->farm_id);

       if($stmt->execute()){
	       return true;
       }
       return false;
    }

    // delete the farm
    function delete(){
	//delete query
	$query = "DELETE FROM " . $this->table_name . " WHERE farm_id = ?";
	
	$stmt = $this->conn->prepare($query);

	$this->farm_id=htmlspecialchars(strip_tags($this->farm_id));

	$stmt->bindParam(1, $this->farm_id);

	if($stmt->execute()){
		return true;
	}

	return false;
    }

}
?>
