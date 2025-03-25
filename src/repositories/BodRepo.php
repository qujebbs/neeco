<?php
    require_once __DIR__ . '/../models/BodModel.php';
    require_once __DIR__ . '/BaseRepo.php';
        class BodRepo extends BaseRepo {
            public function __construct() {
                parent::__construct( 'bod', 'bodId');
            }

        public function insert(Bod $bod){
            $sql = "INSERT INTO {$this->table} (bodName, bodPosition, bodPicture, townId) VALUES (:bodName, :bodPosition, :bodPicture, :townId)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bodName", $bod->bodName);
            $stmt->bindParam(":bodPosition", $bod->bodPosition);
            $stmt->bindParam(":bodPicture", $bod->bodPicture);
            $stmt->bindParam(":townId", $bod->townId);

            return $stmt->execute();
        }
        public function selectByFilter(){
            die();
        }

        public function selectWithJoin(){
            $sql = "SELECT * FROM bod LEFT JOIN towns ON bod.townId = towns.townId";
            $stmt = $this->con->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update(Bod $bod, $id){
            $sql = "UPDATE {$this->table} SET bodName = :bodName, bodPosition = :bodPosition, bodPicture = :bodPicture, townId = :townId WHERE bodId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bodName", $bod->bodName);
            $stmt->bindParam(":bodPosition", $bod->bodPosition);
            $stmt->bindParam(":bodPicture", $bod->bodPicture);
            $stmt->bindParam(":townId", $bod->townId);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }