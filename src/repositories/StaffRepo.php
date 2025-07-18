<?php
    require_once __DIR__ . '/BaseRepo.php';
    require_once __DIR__ . '/../models/StaffModel.php';
    class StaffRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('staffs', 'staffId');
        }

        public function insert(Staff $staff){
            $sql = "INSERT INTO {$this->table} (staffDepartment, staffPic) VALUES (:staffDepartment, :staffPic)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":staffDepartment", $staff->staffDepartment);
            $stmt->bindParam(":staffPic", $staff->staffPic);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update(Staff $staff, $id){
            $sql = "UPDATE {$this->table} SET staffDepartment = :staffDepartment, staffPic = :staffPic WHERE staffId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":staffDepartment", $staff->staffDepartment);
            $stmt->bindParam(":staffPic", $staff->staffPic);

            return $stmt->execute();
        }
    }