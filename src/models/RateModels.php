<?php
    class Rate{
        public $rateId;
        public $pdf;
        public $date;
        public $rateType;

        public function __construct($data = []) {
            $this->rateId = $data['rateId'] ?? null;
            $this->pdf = $data['pdf'] ?? null;
            $this->date = $data['date'] ?? null;
            $this->rateType = $data['rateType'] ?? null;
        }
    }