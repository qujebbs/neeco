<?php
    class ConsumerFilter {
        public ?int $accountId = null;
        public ?int $consumerId = null;
        public ?int $statusId = null;
        public ?int $townId = null;
        public ?string $accountNum = null;


        public function __construct(array $params = []) {
            if (isset($params['accountId'])) $this->accountId = $params['accountId'];
            if (isset($params['consumerId'])) $this->consumerId = $params['consumerId'];
            if (isset($params['accountStatusId'])) $this->statusId = $params['accountStatusId'];
            if (isset($params['townId'])) $this->townId = $params['townId'];
            if (isset($params['accountNum'])) $this->accountNum = $params['accountNum'];
        }

        public function toSqlConditions(): string {
            $conditions = [];

            if ($this->accountId !== null) $conditions[] = "a.accountId = :accountId";
            if ($this->consumerId !== null) $conditions[] = "c.consumerId = :consumerId";
            if ($this->statusId !== null) $conditions[] = "a.accountStatusId = :accountStatusId";
            if ($this->townId !== null) $conditions[] = "c.townId = :townId";
            if ($this->accountNum !== null) $conditions[] = "c.accountNum = :accountNum";
            
            
            return empty($conditions) ? "" : " WHERE " . implode(" AND ", $conditions);
        }
    }