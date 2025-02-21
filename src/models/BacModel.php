<?php
    class Bac{
        public $bacId;
        public $bacName;
        public $bacTitle;
        public $bacUploadDate;
        public $bacDesc;

        public function __construct($data = []) {
            $this->bacId = $data['bacId'] ?? null;
            $this->bacName = $data['bacName'] ?? null;
            $this->bacTitle = $data['bacTitle'] ?? null;
            $this->bacUploadDate = $data['bacUploadDate'] ?? null;
            $this->bacDesc = $data['bacDesc'] ?? null;
        }
    }