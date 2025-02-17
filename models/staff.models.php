<?php 
    class Staff{
        private $con;
        private $table = "staffs";

        public $staffId;
        public $staffDepartment;
        public $staffPic;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert($staff){
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

        public function delete(){
            die();
        }
    }