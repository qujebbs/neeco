<?php 
    require_once 'src/repositories/baseRepo.php';
    require_once 'src/models/ServiceModel.php';
    class ServiceRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('services', 'serviceId');
        }
        public function insert(Service $service){
            $sql = "INSERT INTO {$this->table} (servicePic, serviceTitle, serviceDesc) VALUES (:servicePic, :serviceTitle, :serviceDesc)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":servicePic", $service->servicePic);
            $stmt->bindParam(":serviceTitle", $service->serviceTitle);
            $stmt->bindParam(":serviceDesc", $service->serviceDesc);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update(Service $service, $id){
            $sql = "UPDATE {$this->table} SET servicePic = :servicePic, serviceTitle = :serviceTitle, serviceDesc = :serviceDesc WHERE serviceId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":servicePic", $service->servicePic);
            $stmt->bindParam(":serviceTitle", $service->serviceTitle);
            $stmt->bindParam(":serviceDesc", $service->serviceDesc);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }