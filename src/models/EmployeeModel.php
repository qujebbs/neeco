<?php
    class Employees{
        public $employeeId;
        public $firstname;
        public $midname;
        public $lastname;
        public $suffix;
        public $townId;
        public $contactNum;
        public $gender;
        public $positionId;

        public function __construct($data = []) {
            $this->employeeId = $data['employeeId'] ?? null;
            $this->firstname = $data['firstname'] ?? null;
            $this->midname = $data['midname'] ?? null;
            $this->lastname = $data['lastname'] ?? null;
            $this->suffix = $data['suffix'] ?? null;
            $this->townId = $data['townId'] ?? null;
            $this->contactNum = $data['contactNum'] ?? null;
            $this->gender = $data['gender'] ?? null;
            $this->positionId = $data['positionId'] ?? null;
        }
    }