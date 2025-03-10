<?php
    require_once 'src/repositories/BaseRepo.php';
    require_once 'src/models/townsModel.php';
    class TownsRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('towns', 'townId');
        }
        public function insert(Towns $towns){
            $sql = "INSERT INTO {$this->table} (zoneCode, townDesc, townAbbrv) VALUES (:zoneCode, :townDesc, :townAbbrv)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":zoneCode", $towns->zoneCode);
            $stmt->bindParam(":townDesc", $towns->townDesc);
            $stmt->bindParam(":townAbbrv", $towns->townAbbrv);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update(Towns $towns, $id){
            $sql = "UPDATE {$this->table} SET zoneCode = :zoneCode, townDesc = :townDesc, townAbbrv = :townAbbrv WHERE serviceId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":zoneCode", $towns->zoneCode);
            $stmt->bindParam(":townDesc", $towns->townDesc);
            $stmt->bindParam(":townAbbrv", $towns->townAbbrv);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }