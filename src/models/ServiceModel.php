<?php 
    class Service{
        public $servicePic;
        public $serviceTitle;
        public $serviceDesc;
        public function __construct($data = []) {
            $this->servicePic = $data['servicePic'] ?? null;
            $this->serviceTitle = $data['serviceTitle'] ?? null;
            $this->serviceDesc = $data['serviceDesc'] ?? null;
        }
    }