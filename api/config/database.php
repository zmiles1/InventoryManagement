<?php
class Database{

    /*** mysql server info ***/
    private $host = '127.0.0.1';  // Local host, i.e. running on elvis
    private $username = 'connect_user';           // Your MySQL Username goes here
    private $password = 'lakehylia';           // Your MySQL Password goes here
    private $db_name   = 'chickens';           // For elvis, your MySQL Username is repeated here
    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}
?>
