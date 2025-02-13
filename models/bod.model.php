<?php
    class Bod{
        private $con;
        private $table = "bod";

        public $bodId;
        public $bodName;
        public $bodPosition;
        public $bodPicture;
        public $townId;

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