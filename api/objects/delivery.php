<?php
    class Delivery{
        private $conn;

        public $driver_id;
        public $truck_id;
        public $truck_driver_id;
        public $stop_number;


        //delivery date,store and address
        public $delivery_date;
        public $store_name;
        public $store_address;

        public function __construct($db){
            $this->conn = $db;
        }

        function setTruckDriver(){
            $truck = $this->truck_id;
            $driver = $this->driver_id;

            $query = "SELECT insertDriverTruckCombo('$driver', '$truck');";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        function setRouteStop($stop, $store){
            $truck_driver = $this->truck_driver_id;
            $query = "SELECT insertDeliveryDriverTruckCombo('$truck_driver', '$stop', '$store');";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function insertDeliveryOrders($delivery_id, $store_id){
            $query = "CALL insertDeliveryOrders('$delivery_id', '$store_id');";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function getTomorrowsDeliveryList(){
            $query = "CALL getTomorrowsDeliveryList();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function getDispatchDeliveries(){
            $truck_driver = $this->truck_driver_id;
            $query = "CALL getAssignedDeliveryInformation('$truck_driver');";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function deleteRoute(){
            $truck_driver = $this->truck_driver_id;
            $query = "CALL deleteRoute('$truck_driver');";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

       //gets  delivery assigned  to the truck driver.
               public function getDeliveryListTD(){

                        $driver_id = $this->driver_id;
                        $sql = "CALL getDeliveriesforTD('$driver_id')";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                        return $stmt;
                }

      //gets a store information for the delivery.
              public function getDeliveryStoreinfo($delivery_id){

                    $sql = "CALL getDeliveryStoreInfoTD('$delivery_id')";
                    $stmt = $this->conn->prepare( $sql );
                    $stmt->execute();

                    // get retrieved row
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                   // set values to object properties
                   $this->delivery_date = $row['delivery_date'];
                   $this->store_name = $row['store_name'];
                   $this->store_address = $row['store_address'];
              }

      //get invoice details.
              public function getDeliveryDetailsTD($delivery_id){

                        $sql = "CALL getdeliveryDetailsTD('$delivery_id')";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                        return $stmt;
                }

    }
?>

