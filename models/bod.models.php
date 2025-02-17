<?php
    require_once 'models/baseModel.models.php';
        class Bod extends BaseModel {
            public $bodId;
            public $bodName;
            public $bodPosition;
            public $bodPicture;
            public $townId;
        
            public function __construct($con) {
                parent::__construct($con, 'bod', 'bodId');
            }

        public function insert($service){
            $sql = "INSERT INTO {$this->table} (bodName, bodPosition, bodPicture, townId) VALUES (:bodName, :bodPosition, :bodPicture, :townId)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":bodName", $this->bodName);
            $stmt->bindParam(":bodPosition", $this->bodPosition);
            $stmt->bindParam(":bodPicture", $this->bodPicture);
            $stmt->bindParam(":townId", $this->townId);

            return $stmt->execute();
        }
        public function selectByFilter(){
            die();
        }

        public function update(){
            die();
        }
    }