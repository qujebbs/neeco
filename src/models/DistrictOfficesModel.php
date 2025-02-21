<?php
    class DistrictOffices{
        public $districtId;
        public $districtName;
        public $hotline;
        public $contactNum;
        public $dcso;
        public $teller;
        public $stationLineman;
        public $districtPic;

        public function __construct($data = []) {
            $this->districtId = $data['districtId'] ?? null;
            $this->districtName = $data['districtName'] ?? null;
            $this->hotline = $data['hotline'] ?? null;
            $this->contactNum = $data['contactNum'] ?? null;
            $this->dcso = $data['dcso'] ?? null;
            $this->teller = $data['teller'] ?? null;
            $this->stationLineman = $data['stationLineman'] ?? null;
            $this->districtPic = $data['districtPic'] ?? null;
        }
    }