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

        public function getPositions(){
            $sql = "SELECT * FROM positions";
            $stmt = $this->con->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTowns(){
            $sql = "SELECT * FROM towns";
            $stmt = $this->con->prepare($sql);

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

        public function insert(Employees $employee){
            $sql = "INSERT INTO neeco2area1.dbo.employees (firstname, midname, lastname, suffix, townId, contactNum, gender, positionId)
            VALUES (:firstname, :midname, :lastname, :suffix, :townId, :contactNum, :gender, :positionId)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":firstname", $employee->firstname);
            $stmt->bindParam(":midname", $employee->midname);
            $stmt->bindParam(":lastname", $employee->lastname);
            $stmt->bindParam(":suffix", $employee->suffix);
            $stmt->bindParam(":townId", $employee->townId);
            $stmt->bindParam(":contactNum", $employee->contactNum);
            $stmt->bindParam(":gender", $employee->gender);
            $stmt->bindParam(":positionId", $employee->positionId);

            return $stmt->execute();
        }

        public function update(Employees $employee, $id){
            $sql = "UPDATE neeco2area1.dbo.employees SET positionId = :positionId WHERE employeeId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":positionId", $employee->positionId);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }