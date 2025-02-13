<?php 
    class Complaint{
        private $con;
        private $table = "complaints";

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
            $this->con = $con;
        }

        public function insert($complaint){
            die();
        }

        public function selectAll(){
            die();
        }

        public function selectOne(){
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

        public function delete(){
            die();
        }

    }