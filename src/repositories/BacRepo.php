<?php
    require_once 'BaseRepo.php';
    require_once 'src/models/BacModel.php';

    
    class BacRepo extends BaseRepo{
        public function __construct($con) {
            parent::__construct($con, 'bac', 'bacId');
        }

        public function insert(Bac $bac) {
            $sql = "INSERT INTO {$this->table} (bacName, bacTitle, bacUploadDate, bacDesc) VALUES (:bacName, :bacTitle, :bacUploadDate, :bacDesc)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("bacName", $bac->bacName);
            $stmt->bindParam("bacTitle", $bac->bacTitle);
            $stmt->bindParam("bacUploadDate", $bac->bacUploadDate);
            $stmt->bindParam("bacDesc", $bac->bacDesc);

            return $stmt->execute();
        }
        
        public function update(Bac $bac, $id){
            $sql = "UPDATE awards SET bacName = :bacName, bacTitle = :bacTitle, bacUploadDate = :bacUploadDate, bacDesc = :bacDesc WHERE bacId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bacName", $bac->bacName);
            $stmt->bindParam(":bacTitle", $bac->bacTitle);
            $stmt->bindParam(":bacUploadDate", $bac->bacUploadDate);
            $stmt->bindParam(":bacDesc", $bac->bacDesc);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }