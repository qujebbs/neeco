<?php
    class AccountFilter {
        public ?int $accountId   = null;
        public ?int $consumerId = null;
        public ?int $employeeId = null;
        public ?string $username = null;
        public ?int $positionId = null;
        public ?int $accountStatusId = null;
        public?string $groupBy = null;

        public function __construct(array $params = []) {
            if (isset($params['accountId'])) $this->accountId = $params['accountId'];
            if (isset($params['consumerId'])) $this->consumerId = $params['consumerId'];
            if (isset($params['employeeId'])) $this->employeeId = $params['employeeId'];
            if (isset($params['username'])) $this->username = $params['username'];
            if (isset($params['positionId'])) $this->positionId = $params['positionId'];
            if (isset($params['accountStatusId'])) $this->accountStatusId = $params['accountStatusId'];
            if (isset($params['groupBy'])) $this->groupBy = $params['groupBy'];
        }

        public function toSqlConditions(): string {
            $conditions = [];

            if ($this->accountId !== null) $conditions[] = "a.accountId = :accountId";
            if ($this->consumerId !== null) $conditions[] = "a.consumerId = :consumerId";
            if ($this->employeeId !== null) $conditions[] = "a.employeeId = :employeeId";
            if ($this->username !== null) $conditions[] = "a.username = :username";
            if ($this->positionId !== null) $conditions[] = "a.positionId = :positionId";
            if ($this->accountStatusId !== null) $conditions[] = "a.accountStatusId = :accountStatusId";
            
            $sql =  empty($conditions) ? "" : 
                                        " WHERE " . implode(" AND ", $conditions);

            if ($this->groupBy !== null) {
                $sql .= " GROUP BY " . $this->groupBy;
            }

            return $sql;
        }
    }
