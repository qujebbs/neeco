<?php
    require_once 'models/baseModel.models.php';
    class Complaint extends BaseModel{
        public $complaintId;
        public $cosumerId;
        public $employeeId;
        public $townId;
        public $accountNumber;
        public $landmark;
        public $complaintDesc;
        public $statusId;
        public $complaintDate;
        public $natureId;

        public function __construct($con) {
            parent::__construct($con, 'complaints', 'complaintId');
        }

        public function insert(){
            die();
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