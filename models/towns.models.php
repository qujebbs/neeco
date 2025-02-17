<?php
    class Towns{
        private $con;
        private $table = "towns";

        public $townId;
        public $zoneCode;
        public $townDesc;
        public $townAbbrv;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert($town){
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