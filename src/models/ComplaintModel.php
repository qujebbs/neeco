<?php
class Complaint {
    public $complaintId;
    public $accountId;
    public $employeeId;
    public $townId;
    public $accountNum;
    public $landmark;
    public $complaintDesc;
    public $statusId;
    public $complaintDate;
    public $natureId;

    public function __construct($data = []) {
        $this->complaintId = $data['complaintId'] ?? null;
        $this->accountId = $data['accountId'] ?? null;
        $this->employeeId = $data['employeeId'] ?? null;
        $this->townId = $data['townId'] ?? null;
        $this->accountNum = $data['accountNum'] ?? null;
        $this->landmark = $data['landmark'] ?? null;
        $this->complaintDesc = $data['complaintDesc'] ?? null;
        $this->statusId = $data['statusId'] ?? null;
        $this->complaintDate = $data['complaintDate'] ?? null;
        $this->natureId = $data['natureId'] ?? null;
    }
}
