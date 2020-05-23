<?php
class Message{

    // database connection and table name
    private $conn;
    private $table_name = "Message";

    // object properties
    public $message_id;
    public $user_id;
    public $content;

    public $date_created;

    public $timestamp;
    public $flockmanager_flag;
    public $salesmanager_flag;
    public $truckdriver_flag;



    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



    // read farms
    public function read(){
        // call sql procedure to get query
        $query = "Select * From Message";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create new farm
    public function create(){
        // call sql procedure to add new farm
        // call sql procedure to add new farm
        $content = $this->content;
        $user_id = $this->user_id;
		$flockmanager_flag = $this->flockmanager_flag;
        $salesmanager_flag = $this->salesmanager_flag;
		$truckdriver_flag = $this->truckdriver_flag;
        $sql = "INSERT INTO chickens.Message(user_id,content,flockmanager_flag,salesmanager_flag,truckdriver_flag, date_created) VALUES ('$user_id','$content','$flockmanager_flag','$salesmanager_flag', '$truckdriver_flag', date_sub(now(), interval 5 Hour));";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        echo "New Message has been added to the Database";
        // execute query

    }

    //read messages for truck driver
    public function readfortruckdriver(){

     $sql = "CALL getmessagesforTD()";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     return $stmt;

    }
    
        //read messages for sales driver
    public function readforsalesmanager(){

     $sql = 'select concat(u.first_name, " ", u.last_name) as name, m.content, TIME(m.date_created) as date_created from Message m  left join User u on (m.user_id = u.user_ID) where salesmanager_flag = 1 and date(m.date_created) = date(date_sub(now(), interval 5 Hour));';
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     return $stmt;

    }
    
            //read messages for sales driver
    public function readforflockmanager(){

     $sql = 'select concat(u.first_name, " ", u.last_name) as name, m.content, TIME(m.date_created) as date_created from Message m  left join User u on (m.user_id = u.user_ID) where flockmanager_flag = 1 and date(m.date_created) = date(date_sub(now(), interval 5 Hour));';
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     return $stmt;

    }

}
?>
