<?php
    class Staff{
        public $staffId;
        public $staffDepartment;
        public $staffPic;

        public function __construct($data = []) {
            $this->staffId = $data['staffId'] ?? null;
            $this->staffDepartment = $data['staffDepartment'] ?? null;
            $this->staffPic = $data['staffPic'] ?? null;
        }
    }