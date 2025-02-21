<?php
    class Bill{
    public $billId;
    public $billAmount;
    public $billYrMonth;
    public $kwhUsed;
    public $orAmount;
    public $dueDate;

    public function __construct($data = []) {
        $this->awardId = $data['awardId'] ?? null;
        $this->billId = $data['billId'] ?? null;
        $this->billAmount = $data['billAmount'] ?? null;
        $this->billYrMonth = $data['billYrMonth'] ?? null;
        $this->kwhUsed = $data['kwhUsed'] ?? null;
        $this->orAmount = $data['orAmount'] ?? null;
        $this->dueDate = $data['dueDate'] ?? null;
        }
    }