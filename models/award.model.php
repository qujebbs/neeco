<?php
    class Award{
        private $con;
        private $table = "awards";

        public $awardId;
        public $awardType;
        public $awardName;
        public $awardFrom;
        public $awardDate;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert($award){
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