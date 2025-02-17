<?php
    require_once 'models/baseModel.models.php';
        class Bill extends BaseModel{
        public $billId;
        public $billAmount;
        public $billYrMonth;
        public $kwhUsed;
        public $orAmount;
        public $dueDate;

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

        public function update($id){
            $sql = "UPDATE {$this->table} SET billAmount = :billAmount, billYrMonth = :billYrMonth, kwhUsed = :kwhUsed, orAmount = :orAmount, dueDate = : dueDate WHERE billId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":billAmount", $this->billAmount);
            $stmt->bindParam(":billYrMonth", $this->billYrMonth);
            $stmt->bindParam("kwhUsed", $this->kwhUsed);
            $stmt->bindParam(":orAmount", $this->orAmount);
            $stmt->bindParam(":dueDate", $this->dueDate);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
        
    }
