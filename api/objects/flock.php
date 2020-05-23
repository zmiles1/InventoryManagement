<?php
class Flock{

    // database connection and table name
    private $conn;
    private $table_name = "Flock";

    // object properties
    public $flock_id;
    public $farm_id;
    public $building_id;
    public $bird_type_id;
    public $delivery_date;
    public $hatchlings;
    public $building_number;
    public $building_floor;
    public $bird_desc;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read flocks
    public function read(){
        //call sql procedure to get query
        $query = "CALL getFlock()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create new flock
    public function create(){
        // call sql procedure to add new flock
	    $query = "INSERT INTO
		        Flock
		   SET
			bird_type_id=:bird_type_id, farm_id=:farm_id, building_id=:building_id, 
			delivery_date=:delivery_date, hatchlings=:hatchlings";
			 

        $stmt = $this->conn->prepare($query);
        
        // clean up inputs
        $this->farm_id=htmlspecialchars(strip_tags($this->farm_id));
        $this->building_id=htmlspecialchars(strip_tags($this->building_id));
        $this->hatchlings=htmlspecialchars(strip_tags($this->hatchlings));
        $this->delivery_date=htmlspecialchars(strip_tags($this->delivery_date));
        $this->bird_type_id=htmlspecialchars(strip_tags($this->bird_type_id));

        // bind values 
        $stmt->bindParam(":farm_id", $this->farm_id);
        $stmt->bindParam(":building_id", $this->building_id);
        $stmt->bindParam(":hatchlings", $this->hatchlings);
        $stmt->bindParam(":delivery_date", $this->delivery_date);
        $stmt->bindParam(":bird_type_id", $this->bird_type_id);

        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }

    public function readFarms(){
	    $query = "select fl.flock_id, f.farm_id, f.farm_name, b.building_id, b.building_number,b.building_floor,bt.bird_type_id,
        		bt.bird_desc, fl.delivery_date, fl.hatchlings
		from Flock fl
    			join Farm f using (farm_id)
    			join Building b using (building_id)
    			join Bird_type bt using (bird_type_id)
		where fl.farm_id = ?";

	// prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind farm_id of flock to be updated
        $stmt->bindParam(1, $this->farm_id);

        // execute query
        $stmt->execute();
	return $stmt;
    }
    public function readOne(){
        // query to read one flock
        $query = "select fl.flock_id,f.farm_id, f.farm_name, b.building_id, b.building_number,b.building_floor,bt.bird_type_id, 
        bt.bird_desc, fl.delivery_date, fl.hatchlings
from Flock fl 
    join Farm f using (farm_id)	
    join Building b using (building_id)
    join Bird_type bt using (bird_type_id)
	where fl.flock_id = ? limit 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind farm_id of flock to be updated
        $stmt->bindParam(1, $this->flock_id);

        // execute query
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	// set values to object properties
	$this->farm_id = $row['farm_id'];
	$this->farm_name = $row['farm_name'];
	$this->building_id = $row['building_id'];
        $this->building_number = $row['building_number'];
	$this->building_floor = $row['building_floor'];
	$this->bird_type_id = $row['bird_type_id'];
        $this->bird_desc = $row['bird_desc'];
        $this->delivery_date =$row['delivery_date'];
        $this->hatchlings = $row['hatchlings'];
    }
    
    //update flock
    function update(){
        $query = "UPDATE
                " . $this->table_name . "
                SET
                    farm_id=:farm_id,
                    building_id=:building_id,
		    bird_type_id=:bird_type_id,
		    delivery_date=:delivery_date,
                    hatchlings=:hatchlings
                WHERE
                    flock_id=:flock_id";

       $stmt = $this->conn->prepare($query);

       $this->farm_id=htmlspecialchars(strip_tags($this->farm_id));
       $this->building_id=htmlspecialchars(strip_tags($this->building_id));
       $this->bird_type_id=htmlspecialchars(strip_tags($this->bird_type_id));
       $this->delivery_date=htmlspecialchars(strip_tags($this->delivery_date));
       $this->hatchlings=htmlspecialchars(strip_tags($this->hatchlings));
       $this->flock_id=htmlspecialchars(strip_tags($this->flock_id));

       $stmt->bindParam(':farm_id', $this->farm_id);
       $stmt->bindParam(':building_id', $this->building_id);
       $stmt->bindParam(':bird_type_id', $this->bird_type_id);
       $stmt->bindParam(':delivery_date', $this->delivery_date);
       $stmt->bindParam(':hatchlings', $this->hatchlings);
       $stmt->bindParam(':flock_id', $this->flock_id);

       if($stmt->execute()){
               return true;
       }
       return false;
    }

    // delete the flock
    function delete(){
        //delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE flock_id = ?";

        $stmt = $this->conn->prepare($query);

        $this->flock_id=htmlspecialchars(strip_tags($this->flock_id));

        $stmt->bindParam(1, $this->flock_id);

        if($stmt->execute()){
                return true;
        }

        return false;
    }
}
?>
