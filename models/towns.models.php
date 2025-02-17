<?php
    require_once 'models/baseModel.models.php';
    class Towns extends BaseModel{
        public $townId;
        public $zoneCode;
        public $townDesc;
        public $townAbbrv;

        public function __construct($con) {
            parent::__construct($con, 'towns', 'townId');
        }

        public function insert($town){
            $sql = "INSERT INTO {$this->table} (zoneCode, townDesc, townAbbrv) VALUES (:zoneCode, :townDesc, :townAbbrv)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":zoneCode", $this->zoneCode);
            $stmt->bindParam(":townDesc", $this->townDesc);
            $stmt->bindParam(":townAbbrv", $this->townAbbrv);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET zoneCode = :zoneCode, townDesc = :townDesc, townAbbrv = :townAbbrv WHERE serviceId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":zoneCode", $this->zoneCode);
            $stmt->bindParam(":townDesc", $this->townDesc);
            $stmt->bindParam(":townAbbrv", $this->townAbbrv);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }