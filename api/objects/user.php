<?php
    class User{
        private $conn;
        private $table = "User";

        //User table attributes
        public $user_ID;
        public $name_string;
        public $first_name;
        public $last_name;
	public $permission_set;
	public $auth_string;

        //database connection
        public function __construct($db){
            $this->conn = $db;
        }


        //Get Users
        function read(){

            $sql = "SELECT user_ID, name_string, first_name, last_name, permission_set FROM chickens.User";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }
	
	function create(){
	    $firstname = $this->first_name;
	    $lastname = $this->last_name;
	    $username = $this->name_string;
	    $password = $this->name_string;
	    $permission = $this->permission_set;

	    $query  = "CALL create_user_procedure('$firstname', '$lastname', ";
	    $query .= "'$username', '$password', '$permission')";

	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}

	function login(){
	    $username = $this->name_string;
	    $password = $this->auth_string;

	    $query  = "SELECT user_login('$username', '$password')";

	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}

	function get_user_info(){
	    $userid = $this->user_ID;

	    $query  = "SELECT * FROM chickens.User ";
	    $query .= "WHERE user_ID = '$userid'";

	    $stmt = $this->conn->prepare($query);
	    $stmt->execute();

	    return $stmt;
	}
    }
?>
