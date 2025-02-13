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
                $sql = "INSERT INTO rates (pdf, date, rateType) VALUES (:pdf, :date, :rateType)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':pdf', $this->pdf);
                $stmt->bindParam(':date', $this->date);
                $stmt->bindParam(':rateType', $this->rateType);
        
                return $stmt->execute();
        }
        public function selectAll(){
            $stmt = $this->con->prepare("SELECT * FROM ". $this->table);
            $stmt->execute();
    
            $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    
            return $result;
        }

        public function selectOne($id){
            $sql = $this->con->prepare("SELECT * FROM ". $this->table . " WHERE rateId = :id LIMITT 1");
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

        public function delete(){
            die();
        }
        
    }