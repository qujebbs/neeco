<?php 
    class DistrictOffices{
        private $con;
        private $table= "districtOffices";

        public $districtId;
        public $districtName;
        public $hotline;
        public $contactNum;
        public $dcso;
        public $teller;
        public $stationLineman;
        public $districtPic;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert($districtOffice){
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