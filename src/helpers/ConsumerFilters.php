<?php
    class ConsumerFilter {
        public ?int $accountId = null;
        public ?int $consumerId = null;
        public ?int $statusId = null;
        public ?int $townId = null;


        public function __construct(array $params = []) {
            if (isset($params['accountId'])) $this->complaintId = $params['accountId'];
            if (isset($params['consumerId'])) $this->complaintId = $params['consumerId'];
            if (isset($params['statusId'])) $this->complaintId = $params['statusId'];
            if (isset($params['townId'])) $this->complaintId = $params['townId'];
        }

        public function toSqlConditions(): string {
            $conditions = [];

            if ($this->accountId !== null) $conditions[] = "a.accountId = :accountId";
            if ($this->consumerId !== null) $conditions[] = "c.consumerId = :consumerId";
            if ($this->statusId !== null) $conditions[] = "a.statusId = :statusId";
            if ($this->townId !== null) $conditions[] = "c.townId = :natureId";
            
            
            return empty($conditions) ? "" : " WHERE " . implode(" AND ", $conditions);
        }
    }