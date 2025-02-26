<?php
class Consumer {
    public $consumerId;
    public $townId;
    public $routeCode;
    public $accountNum;
    public $lastName;
    public $firstName;
    public $midName;
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
        $this->lastName = $data['lastName'] ?? null;
        $this->firsName = $data['firsName'] ?? null;
        $this->midName = $data['midName'] ?? null;
        $this->suffix = $data['suffix'] ?? null;
        $this->barangay = $data['barangay'] ?? null;
        $this->profilepix = $data['profilepix'] ?? null;
        $this->backpix = $data['backpix'] ?? null;
        $this->registration = $data['registration'] ?? null;
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
