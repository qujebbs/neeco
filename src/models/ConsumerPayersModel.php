<?php
    class ConsumerPayers{
        public $payerId;
        public $payerName;
        public $payerAddress;
        public function __construct($data = []) {
            $this->payerId = $data['payerId'] ?? null;
            $this->payerName = $data['payerName'] ?? null;
            $this->payerAddress = $data['payerAddress'] ?? null;
        }
    }