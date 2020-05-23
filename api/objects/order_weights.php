<?php

	class Order_Weight{
		private $conn;
		private $table = "Order_Weights";
		//Table attributes
		public $delvDate;
		public $coops;
		public $flockID;
		public $w1;
		public $w2;
		public $trailer;
		//DB Connect
		public function __construct($db){
			$this->conn = $db;
		}

		public function submitWeights(){
			$flockID = $this->flockID;
			$num_coops = $this->coops;
			$deldate = $this->delvDate;
			$weight1 = $this->w1;
			$weight2 = $this->w2;
			$trailernum = $this->trailer;
			$sql = "call recordIncomingWeight(" . $flockID . ", " . $weight1 . ", " . $weight2 . ", " . $num_coops . ", " . $trailernum . ', "' . $deldate . '");';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
	}
?>
