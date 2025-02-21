<?php
    class Towns{
        public $townId;
        public $zoneCode;
        public $townDesc;
        public $townAbbrv;

        public function __construct($data = []) {
            $this->townId = $data['townId'] ?? null;
            $this->zoneCode = $data['zoneCode'] ?? null;
            $this->townDesc = $data['townDesc'] ?? null;
            $this->townAbbrv = $data['townAbbrv'] ?? null;
        }
    }