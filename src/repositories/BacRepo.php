<?php
    require_once __DIR__ . '/../repositories/BaseRepo.php';
    require_once __DIR__ . '/../models/BacModel.php';

    
    class BacRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('bac', 'bacId');
        }

        public function insert(Bac $bac) {
            $sql = "INSERT INTO {$this->table} (bacName, bacTitle, bacUploadDate, bacDesc) VALUES (:bacName, :bacTitle, :bacUploadDate, :bacDesc)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bacName", $bac->bacPdf);
            $stmt->bindParam(":bacTitle", $bac->bacTitle);
            $stmt->bindParam(":bacUploadDate", $bac->bacUploadDate);
            $stmt->bindParam(":bacDesc", $bac->bacDesc);
            
            return $stmt->execute();
        }
        
        public function update(Bac $bac, $id){
            $sql = "UPDATE {$this->table} SET bacName = :bacName, bacTitle = :bacTitle, bacDesc = :bacDesc WHERE bacId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bacName", $bac->bacPdf);
            $stmt->bindParam(":bacTitle", $bac->bacTitle);
            $stmt->bindParam(":bacDesc", $bac->bacDesc);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }