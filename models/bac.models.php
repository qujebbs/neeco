<?php
    require_once("models/baseModel.models.php");

    class Bac extends BaseModel{
        public $bacId;
        public $bacName;
        public $bacTitle;
        public $bacUploadDate;
        public $bacDesc;

        public function __construct($con) {
            parent::__construct($con, 'bac', 'bacId');
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table} (bacName, bacTitle, bacUploadDate, bacDesc) VALUES (:bacName, :bacTitle, :bacUploadDate, :bacDesc)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("bacName", $this->bacName);
            $stmt->bindParam("bacTitle", $this->bacTitle);
            $stmt->bindParam("bacUploadDate", $this->bacUploadDate);
            $stmt->bindParam("bacDesc", $this->bacDesc);

            return $stmt->execute();
        }

        public function update($id){
            $sql = "UPDATE awards SET bacName = :bacName, bacTitle = :bacTitle, bacUploadDate = :bacUploadDate, bacDesc = :bacDesc WHERE bacId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bacName", $this->bacName);
            $stmt->bindParam(":bacTitle", $this->bacTitle);
            $stmt->bindParam(":bacUploadDate", $this->bacUploadDate);
            $stmt->bindParam(":bacDesc", $this->bacDesc);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }