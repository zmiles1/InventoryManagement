<?php
	class Invoice{
		private $conn;
		private $table = "Invoice";

		public $invoice_id;
		public $invoice_date;
		public $invoice_number;
		public $truck_id;
		public $truck_driver_id;
		public $total_coops;
		public $is_dispatched;
		public $store_id;


		public function __construct($db){
			$this->conn = $db;
		}

		public function getInvoices(){
			$sql = 'select distinct invoice_id, date_format(invoice_date, "%m-%d-%y") as invoice_date, store_name from chickens.Invoice join chickens.Store using (store_id) join chickens.Orders using (invoice_id) where invoice_date >= curdate() order by invoice_id;';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function addInvoice(){
			$invoicedate = $this->invoice_date;
			$storeid = $this->store_id;
			$sql = 'insert into chickens.Invoice(invoice_date, store_id) values ("' . $invoicedate . '", ' . $storeid . ");";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function getNewID(){
			$sql = "select invoice_id from chickens.Invoice order by invoice_id desc limit 1;";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}

		public function getTomorrowsInvoices(){
			$query = "CALL getTomorrowsInvoices();";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
	}
?>
