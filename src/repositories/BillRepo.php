<?php
        require_once 'src/repositories/BaseRepo.php';
        require_once 'src/models/BillModel.php';
        class BillRepo extends BaseRepo{
        public function __construct($con) {
            parent::__construct($con, 'bills', 'billId');
        }

        public function insert($bills){
            $sql = "INSERT INTO {$this->table}(consumerId, billYearMonth, billAmount, kwhUsed, orDate, orAmount, dueDate, disconnectionDate)
                    VALUES (:consumerId, :billYearMonth, :billAmount, :kwhUsed, :orDate, :orAmount, :dueDate, :disconnectionDate)";
                    $stmt = $this->con->prepare($sql);

            foreach($bills as $bill){
                $stmt->bindParam("consumerId", $bill->consumerId);
                $stmt->bindParam("billYearMonth", $bill->billYearMonth);
                $stmt->bindParam("billAmount", $bill->billAmount);
                $stmt->bindParam("kwhUsed", $bill->kwhUsed);
                $stmt->bindParam("orDate", $bill->orDate);
                $stmt->bindParam("orAmount", $bill->orAmount);
                $stmt->bindParam("dueDate", $bill->dueDate);
                $stmt->bindParam("disconnectionDate", $bill->disconnectionDate);
                $stmt->execute();
            }
        }
        public function selectByFilter($filter){
            die();
        }

        public function selectWithJoin($consumerId){
            $sql ="SELECT TOP {$this->limit} *
                    FROM consumers
                    INNER JOIN bills ON consumers.consumerId = bills.consumerId
                    LEFT JOIN towns ON consumers.townId = towns.townId
                    WHERE bills.consumerId = :id ORDER BY billId DESC";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $consumerId);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update(Bill $bill, $id){
            $sql = "UPDATE {$this->table} SET billAmount = :billAmount, billYrMonth = :billYrMonth, kwhUsed = :kwhUsed, orAmount = :orAmount, dueDate = : dueDate WHERE billId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":billAmount", $bill->billAmount);
            $stmt->bindParam(":billYrMonth", $bill->billYearMonth);
            $stmt->bindParam("kwhUsed", $bill->kwhUsed);
            $stmt->bindParam(":orAmount", $bill->orAmount);
            $stmt->bindParam(":dueDate", $bill->dueDate);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
        
    }
