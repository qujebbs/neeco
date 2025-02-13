<?php 
    class Service{
        private $con;
        private $table = "services";

        public $servicePic;
        public $serviceTitle;
        public $serviceDesc;
        public function __construct($con) {
            $this->con = $con;
        }

        public function insert($service){
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