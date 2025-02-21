<?php 
    require_once 'models/baseModel.models.php';
    class Service extends BaseModel{
        public $servicePic;
        public $serviceTitle;
        public $serviceDesc;
        public function __construct($con) {
            parent::__construct($con, 'services', 'serviceId');
        }
        public function insert(){
            $sql = "INSERT INTO {$this->table} (servicePic, serviceTitle, serviceDesc) VALUES (:servicePic, :serviceTitle, :serviceDesc)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":servicePic", $this->servicePic);
            $stmt->bindParam(":serviceTitle", $this->serviceTitle);
            $stmt->bindParam(":serviceDesc", $this->serviceDesc);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET servicePic = :servicePic, serviceTitle = :serviceTitle, serviceDesc = :serviceDesc WHERE serviceId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":servicePic", $this->servicePic);
            $stmt->bindParam(":serviceTitle", $this->serviceTitle);
            $stmt->bindParam(":serviceDesc", $this->serviceDesc);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }