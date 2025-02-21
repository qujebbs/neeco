<?php
        require_once 'src/repositories/BaseRepo.php';
        require_once 'src/models/BillModels.php';
        class BillRepo extends BaseRepo{
        public function __construct($con) {
            parent::__construct($con, 'bills', 'billId');
        }

        //remove file handling
        public function insert($csvFile){
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            // fgetcsv($handle); Skip the header row

            $sql = "INSERT INTO bills (consumerId, billYearMonth, billAmount, kwhUsed, orDate, orAmount, dueDate, disconnectionDate) VALUES (:consumerId, :billYearMonth, :billAmount, :kwhUsed, :orDate, :orAmount, :dueDate, :disconnectionDate)";
            $stmt = $this->con->prepare($sql);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $stmt->bindParam(':consumerId', $data[0]);
                $stmt->bindParam(':billYearMonth', $data[1]);
                $stmt->bindParam(':billAmount', $data[2]);
                $stmt->bindParam(':kwhUsed', $data[3]);
                $stmt->bindParam(':orDate', $data[4]);
                $stmt->bindParam(':orAmount', $data[5]);
                $stmt->bindParam(':dueDate', $data[6]);
                $stmt->bindParam(':disconnectionDate', $data[7]);
                $stmt->execute();
            }

            fclose($handle);
            echo "CSV data inserted successfully!";
            return true;
            } else {
                echo "Error opening file!";
                return false;
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
            $stmt->bindParam(":billYrMonth", $bill->billYrMonth);
            $stmt->bindParam("kwhUsed", $bill->kwhUsed);
            $stmt->bindParam(":orAmount", $bill->orAmount);
            $stmt->bindParam(":dueDate", $bill->dueDate);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
        
    }
