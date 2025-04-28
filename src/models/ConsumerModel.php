<?php
class Consumer {
    public $consumerId;
    public $townId;
    public $routeCode;
    public $accountNum;
    public $lastname;
    public $firstname;
    public $midname;
    public $suffix;
    public $barangay;
    public $profilepix;
    public $backpix;
    public $registrationDate;
    public $contactNum;
    public $poleId;
    public $meterSRN;
    public $employeeName;
    public $date;
    public $time;
    public $transferrable;
    public $email;

    public function __construct($data = []) {
        $this->consumerId = $data['consumerId'] ?? null;
        $this->townId = $data['townId'] ?? null;
        $this->routeCode = $data['routeCode'] ?? null;
        $this->accountNum = $data['accountNum'] ?? null;
        $this->lastname = $data['lastname'] ?? null;
        $this->firstname = $data['firstname'] ?? null;
        $this->midname = $data['midname'] ?? null;
        $this->suffix = $data['suffix'] ?? null;
        $this->barangay = $data['barangay'] ?? null;
        $this->profilepix = $data['profilepix'] ?? null;
        $this->backpix = $data['backpix'] ?? null;
        $this->registrationDate = $data['registrationDate'] ?? null;
        $this->contactNum = $data['contactNum'] ?? null;
        $this->poleId = $data['poleId'] ?? null;
        $this->meterSRN = $data['meterSRN'] ?? null;
        $this->employeeName = $data['employeeName'] ?? null;
        $this->date = $data['date'] ?? null;
        $this->time = $data['time'] ?? null;
        $this->transferrable = $data['transferrable'] ?? null;
        $this->email = $data['email'] ?? null;
    }
}
