
<?php
    class Truck{
	private $conn;

	public $truck_id;
	public $truck_status;
	public $truck_vin;
	public $truck_plate_number;
	public $truck_max_coops;
	public $truck_transmission;
	public $truck_number;
	public $box_type;

	public function __construct($db){
	    $this->conn = $db;
	}

	function read(){
	    $query = "SELECT * FROM chickens.Truck";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}
    
        // create new farm
    public function create(){
        // call sql procedure to add new farm
        $truck_number = $this->truck_number;
		$truck_vin = $this->truck_vin;
        $truck_plate_number = $this->truck_plate_number;
        $truck_max_coops = $this->truck_max_coops;
        $truck_transmission = $this->truck_transmission;
        $sql = "INSERT INTO chickens.Truck(truck_number,truck_vin,truck_plate_number, truck_max_coops, truck_transmission) VALUES ('$truck_number','$truck_vin','$truck_plate_number','$truck_max_coops', '$truck_transmission');";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
}


    public function activateTruck(){
        $truck_id = $this->truck_id;
        $sql = "Update chickens.Truck SET truck_status = 1 where truck_id = $truck_id;";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
    }
    
        public function deactivateTruck(){
        $truck_id = $this->truck_id;
        $sql = "Update chickens.Truck SET truck_status = 0 where truck_id = $truck_id;";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
    }
    

	function getTomorrowsAvailableTrucks(){
	    $trans = $this->truck_transmission;
	    $query = "CALL getTomorrowsAvailableTrucks('$trans');";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}

	function getTransmissionType(){
	    $id = $this->truck_id;
	    $query = "SELECT truck_transmission FROM chickens.Truck WHERE truck_id = '$id';";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}

	function getMaxCoops(){
	    $id = $this->truck_id;
	    $query = "SELECT truck_max_coops FROM chickens.Truck WHERE truck_id = '$id';";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}
    }
?>

