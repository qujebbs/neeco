<?php

    class Account{
        public $accountId;
        public $consumerId;
        public $employeeId;
        public $username;
        public $password;
        public $positionId;
        public $registrationDate;
        public $accountStatusId;
        public $verificationCode;
        public $isActive;
        public $townId;

        public function __construct($data = []) {
            $this->accountId = $data['accountId'] ?? null;
            $this->consumerId = $data['consumerId'] ?? null;
            $this->employeeId = $data['employeeId'] ?? null;
            $this->username = $data['username'] ?? null;
            $this->password = $data['password'] ?? null;
            $this->positionId = $data['positionId'] ?? null;
            $this->registrationDate = $data['registrationDate'] ?? null;
            $this->accountStatusId = $data['accountStatusId'] ?? null;
            $this->verificationCode = $data['verificationCode'] ?? null;
            $this->isActive = $data['isActive'] ?? null;
            $this->townId = $data['townId'] ?? null;
        }
    }