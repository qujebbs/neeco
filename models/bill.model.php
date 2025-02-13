<?php 
        class Bill {
        private $con;
        private $table = "bills";

        public $billId;
        public $billAmount;
        public $billYrMonth;
        public $kwhUsed;
        public $orAmount;
        public $dueDate;

        public function __construct($con) {
            $this->con = $con;
        }

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

        public function selectAll(){
            $stmt = $this->con->prepare("SELECT * FROM ". $this->table);
            $stmt->execute();
    
            $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    
            return $result;
        }
        
        public function selectOne($id){
            $sql = $this->con->prepare("SELECT * FROM ". $this->table . " WHERE billId = :id LIMITT 1");
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchall(PDO :: FETCH_ASSOC);
        }

        public function selectByFilter($filter){
            die();
        }

        public function update(){
            die();
        }
        
        public function delete($id){
            die();
        }
    }
