<?php
    require_once __DIR__ . "/../repositories/BaseRepo.php";
    require_once __DIR__ . "/../models/EmployeeModel.php";

    class EmployeeRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('employees', 'employeeId');
        }

        public function getEmployeesByTown($townId){
            $sql = "SELECT * FROM {$this->table} WHERE townId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $townId);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getEmployeesById($employeeId){
            $sql = "SELECT * FROM {$this->table} WHERE employeeId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $employeeId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTownDcso($townId){
            $sql = "SELECT * FROM {$this->table} WHERE townId = :id AND positionId = 7";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $townId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }