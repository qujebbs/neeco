<?php
    require_once("src/repositories/BaseRepo.php");
    require_once("src/models/ConsumerPayersModel.php");

    class ConsumerPayersRepo extends BaseRepo {
        public function __construct($con) {
            parent::__construct($con, 'consumerPromptPayers', 'payerId');
        }

        public function insert(ConsumerPayers $consumerPayers) {
            $sql = "INSERT INTO {$this->table} (payerName, payerAddress) VALUES (:payerName, :payerAddress)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("payerName", $consumerPayers->payerName);
            $stmt->bindParam("payerAddress", $consumerPayers->payerAddress);

            return $stmt->execute();
        }

        public function update(ConsumerPayers $consumerPayers,$id){
            $sql = "UPDATE awards SET payerName = :payerName, payerAddress = :payerAddress WHERE payerId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":payerName", $consumerPayers->payerName);
            $stmt->bindParam(":payerAddress", $consumerPayers->payerAddress);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }