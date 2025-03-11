<?php
        require_once 'src/repositories/BaseRepo.php';
        require_once 'src/models/BillModel.php';
        class BillRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('bills', 'billId');
        }

        public function insert(array $bills) {
            if (empty($bills)) return false;
        
            $values = [];
            $params = [];
            
            foreach ($bills as $bill) {
                $values[] = "(?, ?, ?, ?, ?, ?, ?, ?)";
                $params[] = $bill->consumerId;
                $params[] = $bill->billYearMonth;
                $params[] = $bill->billAmount;
                $params[] = $bill->kwhUsed;
                $params[] = $bill->orDate;
                $params[] = $bill->orAmount;
                $params[] = $bill->dueDate;
                $params[] = $bill->disconnectionDate;
            }
        
            $sql = "INSERT INTO {$this->table} 
                    (consumerId, billYearMonth, billAmount, kwhUsed, orDate, orAmount, dueDate, disconnectionDate) 
                    VALUES " . implode(", ", $values);
        
            $stmt = $this->con->prepare($sql);
            return $stmt->execute($params);
        }
        
        public function selectByFilter($filter){
            die();
        }

        public function selectWithJoin($consumerId = null) {
            $sql = "SELECT TOP {$this->limit} *
                    FROM consumers
                    INNER JOIN bills ON consumers.consumerId = bills.consumerId
                    LEFT JOIN towns ON consumers.townId = towns.townId";
        
            if ($consumerId !== null) {
                $sql .= " WHERE bills.consumerId = :id";
            }
        
            $sql .= " ORDER BY billId DESC";
        
            $stmt = $this->con->prepare($sql);
        
            if ($consumerId !== null) {
                $stmt->bindParam(":id", $consumerId);
            }
        
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
