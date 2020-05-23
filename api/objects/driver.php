
<?php
    class Driver{
	private $conn;
    private $table_name = "Driver";

    public $driver_id;
    public $first_name;
    public $last_name;
    public $phone_number;
    public $date_of_birth;
    public $license_st;
    public $license_number;
    public $license_type;
    public $license_expiration;
    public $medical_expiration;
    public $transmission_type;
    public $driver_status;
    public $user_ID;

	public function __construct($db){
	    $this->conn = $db;
	}

	function read(){
	    $query = "SELECT * FROM chickens.Driver ORDER BY last_name";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}
    
        // create new farm
    public function driverCreate(){
        // call sql procedure to add new farm

        
        $first_name = $this->first_name;
        $last_name= $this->last_name;
        $phone_number = $this->phone_number;
        $date_of_birth= $this->date_of_birth;
        $license_st= $this->license_st;
        $license_number= $this->license_number;
        $license_type= $this->license_type;
        $license_expiration= $this->license_expiration;
        $medical_expiration= $this->medical_expiration;
        $transmission_type= $this->transmission_type;
        //$driver_status= $this->driver_status;
        $user_ID= $this->user_ID;
 
        
        $sql = "INSERT INTO chickens.Driver(first_name,last_name,phone_number, date_of_birth, license_st, license_number, license_type, license_expiration, medical_expiration, transmission_type, user_ID, driver_status)
        VALUES ('$first_name','$last_name','$phone_number','$date_of_birth','$license_st','$license_number','$license_type','$license_expiration','$medical_expiration','$transmission_type','$user_ID', '1');";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
}
    
	function getTomorrowsAvailableDrivers(){
	    $trans = $this->transmission_type;
	    $query = "CALL getTomorrowsAvailableDrivers('$trans');";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}
    
            //read messages for sales driver
    public function readfordriver(){

     $sql = 'select concat(u.first_name, " ", u.last_name) as driverName, u.user_ID from chickens.User u where u.user_ID not in (select d.user_ID from chickens.Driver d) and u.permission_set = "Truck Driver" and u.active_status = 1;';
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     return $stmt;

    }
    }
?>

