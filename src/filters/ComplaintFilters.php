<?php
class ComplaintFilter {
    public ?int $complaintId = null;
    public ?int $accountId = null;
    public ?int $employeeId = null;
    public ?int $natureId = null;
    public ?int $statusId = null;
    public ?string $groupBy = null;
    public ?int $townId = null;
    public ?int $orAccountId = null;


    public function __construct(array $params = []) {
        if (isset($params['complaintId'])) $this->complaintId = $params['complaintId'];
        if (isset($params['accountId'])) $this->accountId = $params['accountId'];
        if (isset($params['consumerId'])) $this->consumerId = $params['consumerId'];
        if (isset($params['employeeId'])) $this->employeeId = $params['employeeId'];
        if (isset($params['natureId'])) $this->natureId = $params['natureId'];
        if (isset($params['statusId'])) $this->statusId = $params['statusId'];
        if (isset($params['townId'])) $this->townId = $params['townId'];
        if (isset($params['groupBy'])) $this->groupBy = $params['groupBy'];
        if (isset($params['orAccountId'])) $this->orAccountId = $params['orAccountId'];
    }

    public function toSqlConditions(): string {
        $andConditions = [];
        $orConditions = [];
    
        if ($this->complaintId !== null) $andConditions[] = "c.complaintId = :complaintId";
        if ($this->accountId !== null) $andConditions[] = "c.accountId = :accountId";
        if ($this->employeeId !== null) $andConditions[] = "c.employeeId = :employeeId";
        if ($this->natureId !== null) $andConditions[] = "c.natureId = :natureId";
        if ($this->statusId !== null) $andConditions[] = "c.statusId = :statusId";
        if ($this->townId !== null) $andConditions[] = "c.townId = :townId";
    
        if ($this->orAccountId !== null) $orConditions[] = "c.accountId = :orAccountId";
    
        $sql = '';
    
        if (!empty($andConditions) || !empty($orConditions)) {
            $sql .= " WHERE ";
            if (!empty($andConditions)) {
                $sql .= implode(" AND ", $andConditions);
            }
            if (!empty($orConditions)) {
                if (!empty($andConditions)) {
                    $sql .= " OR ";
                }
                $sql .= implode(" OR ", $orConditions);
            }
        }
    
        if ($this->groupBy !== null) {
            $sql .= " GROUP BY " . $this->groupBy;
        }
    
        return $sql;
    }    
}
