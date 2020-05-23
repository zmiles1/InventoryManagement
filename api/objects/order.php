<?php
	class Order{
		private $conn;
		private $table = "Orders";

		//Table attributes
		public $order_id;
		public $delivery_date;
		public $number_coops;
		public $store_id;
		public $flock_id;
		public $store_name;
		public $flock_name;
		public $invoice_id;

		//DB Connect
		public function __construct($db){
			$this->conn = $db;
		}

		public function getCurrentOrders(){
			$sql = "call getCurrentOrders();";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function getById(){
			$invoiceid = $this->invoice_id;
			$sql = "select order_id, number_coops, bird_desc from chickens.Orders join chickens.Flock using (flock_id) join chickens.Bird_type using (bird_type_id) where invoice_id = " . $invoiceid . ";";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function insertOrder(){
			$storeid = $this->store_id;
			$flockid = $this->flock_id;
			$deldate = $this->delivery_date;
			$numcoops = $this->number_coops;
			$invoiceid = $this->invoice_id;
			$sql = "call addOrder(" . $numcoops . ', "' . $deldate . '", ' . $storeid . ", " . $flockid . ", " . $invoiceid . ");";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function removeOrder(){
			$id = $this->order_id;
			$sql = "call removeOrder(" . $id . ");";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function getTomorrowsDeliveries(){
		        $query = "CALL getTomorrowsDeliveryOrders();";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
		
		public function getTomorrowsIndividualOrders(){
			$id = $this->store_id;
			$query = "CALL getTomorrowsIndividualOrders('$id');";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function showOrders(){
			$sql = "call showOrders();";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
	}
?>
