<?php
    class ComplaintFilter {
        public ?int $complaintId = null;
        public ?int $accountId = null;
        public ?int $employeeId = null;
        public ?int $natureId = null;
        public ?int $statusId = null;

        public function __construct(array $params = []) {
            if (isset($params['complaintId'])) $this->complaintId = $params['complaintId'];
            if (isset($params['consumerId'])) $this->consumerId = $params['consumerId'];
            if (isset($params['employeeId'])) $this->employeeId = $params['employeeId'];
            if (isset($params['natureId'])) $this->natureId = $params['natureId'];
            if (isset($params['statusId'])) $this->statusId = $params['statusId'];
        }

        public function toSqlConditions(): string {
            $conditions = [];

            if ($this->complaintId !== null) $conditions[] = "c.complaintId = :complaintId";
            if ($this->accountId !== null) $conditions[] = "c.accountId = :accountId";
            if ($this->employeeId !== null) $conditions[] = "c.employeeId = :employeeId";
            if ($this->natureId !== null) $conditions[] = "c.natureId = :natureId";
            if ($this->statusId !== null) $conditions[] = "c.statusId = :statusId";
            
            
            return empty($conditions) ? " ORDER BY complaintDate DESC" : 
                                        " WHERE " . implode(" AND ", $conditions) . " ORDER BY complaintDate DESC";

        }
    }
