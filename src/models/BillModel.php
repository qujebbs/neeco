<?php
    class Bill{
    public $consumerId;
    public $billYearMonth;
    public $billAmount;
    public $kwhUsed;
    public $orDate;
    public $orAmount;
    public $dueDate;
    public $disconnectionDate;

    public function __construct($data = []) {
        $this->consumerId = $data['consumerId'] ?? null;
        $this->billYearMonth = $data['billYearMonth'] ?? null;
        $this->billAmount = $data['billAmount'] ?? null;
        $this->kwhUsed = $data['kwhUsed'] ?? null;
        $this->orDate = $data['orDate'] ?? null;
        $this->orAmount = $data['orAmount'] ?? null;
        $this->dueDate = $data['dueDate'] ?? null;
        $this->disconnectionDate = $data['disconnectionDate'] ?? null;
        }
    }