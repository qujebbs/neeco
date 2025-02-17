<?php
    require_once("src/db.php");
    class Award{
        private $con;
        private $table = "awards";

        public $awardId;
        public $awardType;
        public $awardName;
        public $awardFrom;
        public $awardDate;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table} (awardType, awardName, awardFrom, awardDate) VALUES (:awardType, :awardName, :awardFrom, :awardDate)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("awardType", $this->awardType);
            $stmt->bindParam("awardName", $this->awardName);
            $stmt->bindParam("awardFrom", $this->awardFrom);
            $stmt->bindParam("awardDate", $this->awardDate);

            return $stmt->execute();
        }

        public function selectAll(){
            $stmt = $this->con->prepare("SELECT * FROM ". $this->table);
            $stmt->execute();
    
            return $stmt->fetchall(PDO :: FETCH_ASSOC);
        }

        public function selectOne($id){
            $stmt = $this->con->prepare("SELECT TOP 1 * FROM ". $this->table . " WHERE awardId = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchall(PDO :: FETCH_ASSOC);
        }

        public function selectByFilter(){
            die();
        }

        public function update($id){
            $sql = "UPDATE awards SET awardType = :awardType, awardName = :awardName, awardFrom = :awardFrom, awardDate = :awardDate WHERE awardId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":awardType", $this->awardType);
            $stmt->bindParam(":awardName", $this->awardName);
            $stmt->bindParam(":awardFrom", $this->awardFrom);
            $stmt->bindParam(":awardDate", $this->awardDate);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }

        public function delete($id){
            $sql = "DELETE FROM {$this->table} WHERE awardId = :id";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(":id", $id);
            
            return $stmt->execute();
        }
    }