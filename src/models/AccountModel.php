<?php

    class Account{
        public $accountId;
        public $consumerId;
        public $employeeId;
        public $userName;
        public $passwrord;
        public $positionId;
        public $registrationDate;
        public $accountStatusId;
        public $verificationCode;
        public $isActive;

        public function __construct($data = []) {
            $this->accountId = $data['accountId'] ?? null;
            $this->consumerId = $data['consumerId'] ?? null;
            $this->employeeId = $data['employeeId'] ?? null;
            $this->userName = $data['userName'] ?? null;
            $this->passwrord = $data['passwrord'] ?? null;
            $this->positionId = $data['positionId'] ?? null;
            $this->registrationDate = $data['registrationDate'] ?? null;
            $this->accountStatusId = $data['accountStatusId'] ?? null;
            $this->verificationCode = $data['verificationCode'] ?? null;
            $this->isActive = $data['isActive'] ?? null;
        }
    }