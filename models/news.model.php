<?php
    class News{
        private $con;
        private $table = "news";

        public $newsId;
        public $newsPic;
        public $newsTitle;
        public $newsDescription;
        public $employeeId;
        public $newsDate;

        public function __construct($con) {
            $this->con = $con;
        }

        public function insert($news){
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