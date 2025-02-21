<?php
    require_once("models/baseModel.models.php");

    class ConsumerPayers extends BaseModel {
        public $payerId;
        public $payerName;
        public $payerAddress;

        public function __construct($con) {
            parent::__construct($con, 'consumerPromptPayers', 'payerId');
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table} (payerName, payerAddress) VALUES (:payerName, :payerAddress)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("payerName", $this->payerName);
            $stmt->bindParam("payerAddress", $this->payerAddress);

            return $stmt->execute();
        }

        public function update($id){
            $sql = "UPDATE awards SET payerName = :payerName, payerAddress = :payerAddress WHERE payerId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":payerName", $this->payerName);
            $stmt->bindParam(":payerAddress", $this->payerAddress);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }