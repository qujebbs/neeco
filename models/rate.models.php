<?php
    require_once("src/db.php");
    class Rate{
        private $con;
        private $table = "rates";

        public $rateId;
        public $pdf;
        public $date;
        public $rateType;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert(){
                $sql = "INSERT INTO {$this->table} (pdf, date, rateType) VALUES (:pdf, :date, :rateType)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':pdf', $this->pdf);
                $stmt->bindParam(':date', $this->date);
                $stmt->bindParam(':rateType', $this->rateType);
        
                return $stmt->execute();
        }
        public function selectAll(){
            $stmt = $this->con->prepare("SELECT * FROM ". $this->table);
            $stmt->execute();
    
            return $stmt->fetchall(PDO :: FETCH_ASSOC);
        }

        public function selectOne($id){
            $stmt = $this->con->prepare("SELECT TOP 1 * FROM ". $this->table . " WHERE rateId = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchall(PDO :: FETCH_ASSOC);
        }

        public function selectByFilter($filter){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET pdf = :pdf, [date] = :date, rateType = :rateType WHERE rateId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":pdf", $this->pdf);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":rateType", $this->rateType);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }

        public function delete($id){
            $sql = "DELETE FROM awards WHERE award_id = :id";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(":id", $id);
            
            return $stmt->execute();
        }
        
    }