<?php
        class ComplaintAction{
            public $complaintId;
            public $actionDetails;
            public $startDate;
            public $endDate;
            public $employeeId;
        
            public function __construct($data = []) {
                $this->complaintId = $data['complaintId'] ?? null;
                $this->actionDetails = $data['actionDetails'] ?? null;
                $this->startDate = $data['startDate'] ?? null;
                $this->endDate = $data['endDate'] ?? null;
                $this->employeeId = $data['employeeId'] ?? null;
            }
    }