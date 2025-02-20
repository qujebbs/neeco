<?php
    require_once 'models/baseModel.models.php';
    class Complaint extends BaseModel{
        public $complaintId;
        public $consumerId;
        public $employeeId;
        public $townId;
        public $accountNum;
        public $landmark;
        public $complaintDesc;
        public $statusId;
        public $complaintDate;
        public $natureId;

        public function __construct($con) {
            parent::__construct($con, 'complaints', 'complaintId');
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table}(consumerId, employeeId, townId, accountNum, landmark, complaintDesc, statusId, complaintDate, natureId) \
                    VALUES (:consumerId, :employeeId, :townId, :accountNum, :landmark, :complaintDesc, :statusId, :complaintDate, :natureId)";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(":consumerId", $this->consumerId);
            $stmt->bindParam(":employeeId", $this->employeeId);
            $stmt->bindParam(":townId", $this->townId);
            $stmt->bindParam(":accountNum", $this->accountNum);
            $stmt->bindParam(":landmark", $this->landmark);
            $stmt->bindParam(":complaintDesc", $this->complaintDesc);
            $stmt->bindParam(":statusId", $this->statusId);
            $stmt->bindParam(":complaintDate", $this->complaintDate);
            $stmt->bindParam(":natureId", $this->natureId);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update(){
            die();
        }

        public function updateByFilter($filter){
            die();
        }
    }