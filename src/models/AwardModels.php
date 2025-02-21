<?php
    class Award{
        public $awardId;
        public $awardType;
        public $awardName;
        public $awardFrom;
        public $awardDate;

        public function __construct($data = []) {
            $this->awardId = $data['awardId'] ?? null;
            $this->awardType = $data['awardType'] ?? null;
            $this->awardName = $data['awardName'] ?? null;
            $this->awardFrom = $data['awardFrom'] ?? null;
            $this->awardDate = $data['awardDate'] ?? null;
        }
    }