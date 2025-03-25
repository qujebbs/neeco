<?php
    class Bac{
        public $bacId;
        public $bacPdf;
        public $bacTitle;
        public $bacUploadDate;
        public $bacDesc;

        public function __construct($data = []) {
            $this->bacId = $data['bacId'] ?? null;
            $this->bacPdf = $data['bacPdf'] ?? null;
            $this->bacTitle = $data['bacTitle'] ?? null;
            $this->bacUploadDate = $data['bacUploadDate'] ?? null;
            $this->bacDesc = $data['bacDesc'] ?? null;
        }
    }