<?php
    require_once 'models/baseModel.models.php';
    class Award extends BaseModel{
        public $awardId;
        public $awardType;
        public $awardName;
        public $awardFrom;
        public $awardDate;

        public function __construct($con) {
            parent::__construct($con, 'awards', 'awardId');
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
    }