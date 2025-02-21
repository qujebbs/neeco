<?php
    require_once 'models/baseModel.models.php';
    require_once 'models/helpers/ComplaintFilters.php';
    class Complaint extends BaseModel{
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

        public function __construct($con) {
            parent::__construct($con, 'complaints', 'complaintId');
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table}(accountId, employeeId, townId, accountNum, landmark, complaintDesc, statusId, complaintDate, natureId)
                    VALUES (:accountId, :employeeId, :townId, :accountNum, :landmark, :complaintDesc, :statusId, :complaintDate, :natureId)";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(":accountId", $this->accountId);
            $stmt->bindParam(":employeeId", $this->employeeId);
            $stmt->bindParam(":townId", $this->townId);
            $stmt->bindParam(":accountNum", $this->accountNum);
            $stmt->bindParam(":landmark", $this->landmark);
            $stmt->bindParam(":complaintDesc", $this->complaintDesc);
            $stmt->bindParam(":statusId", $this->statusId);
            $stmt->bindParam(":complaintDate", $this->complaintDate);
            $stmt->bindParam(":natureId", $this->natureId);

            return $stmt->execute();
        }

        public function selectByFilter(ComplaintFilter $filter){
                $sql = "SELECT * FROM neeco2area1.dbo.complaints c
                        LEFT JOIN 	towns t ON c.townId=t.townId
                        LEFT JOIN 	accounts a ON a.accountId=c.accountId
                        LEFT JOIN   employees e ON e.employeeId=c.employeeId
                        LEFT JOIN   complaintStatus s ON s.statusId=c.statusId
                        LEFT JOIN 	complaintNatures cn2 ON cn2.natureId=c.natureId";
                $conditions = $filter->toSqlConditions();
        
                if (!empty($conditions)) {
                    $sql .= $conditions;
                }
        
                $stmt = $this->con->prepare($sql);

                if ($filter->complaintId !== null) $stmt->bindParam(':complaintId', $filter->complaintId);
                if ($filter->accountId !== null) $stmt->bindParam(':accountId', $filter->accountId);
                if ($filter->employeeId !== null) $stmt->bindParam(':employeeId', $filter->employeeId);
                if ($filter->natureId !== null) $stmt->bindParam(':natureId', $filter->natureId);
                if ($filter->statusId !== null) $stmt->bindParam(':statusId', $filter->statusId);

                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }

        public function update(){
            $sql = "UPDATE {$this->table} SET employeeId = :employeeId, statusId = :statusId, natureId = :natureId WHERE complaintId = :complaintId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":employeeId", $this->employeeId);
            $stmt->bindParam(":statusId", $this->statusId);
            $stmt->bindParam("natureId", $this->natureId);
            $stmt->bindParam("complaintId", $this->complaintId);

            return $stmt->execute();
        }

        public function updateByFilter($filter){
            die();
        }
    }