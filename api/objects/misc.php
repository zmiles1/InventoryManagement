<?php
    class Misc{
	private $conn;

	public function __construct($db){
	    $this->conn = $db;
	}

	function getTomorrowsDate(){
	    $query = "SELECT getTomorrowsDate() AS tomDate;";
	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();
	    return $stmt;
	}
    }
?>
