<?php
    require_once 'models/baseModel.models.php';
    class Staff extends BaseModel{
        public $staffId;
        public $staffDepartment;
        public $staffPic;

        public function __construct($con) {
            parent::__construct($con, 'staffs', 'staffId');
        }

        public function insert($staff){
            $sql = "INSERT INTO {$this->table} (staffDepartment, staffPic) VALUES (:staffDepartment, :staffPic)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":servicePic", $this->staffDepartment);
            $stmt->bindParam(":serviceTitle", $this->staffPic);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET staffDepartment = :staffDepartment, staffPic = :staffPic WHERE serviceId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":staffDepartment", $this->staffDepartment);
            $stmt->bindParam(":staffPic", $this->staffPic);

            return $stmt->execute();
        }
    }