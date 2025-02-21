<?php
    require_once 'src/repositories/baseRepo.php';
    require_once 'src/helpers/ComplaintFilters.php';
    require_once 'src/models/ComplaintModels.php';
    class ComplaintRepo extends BaseRepo{
        public function __construct($con) {
            parent::__construct($con, 'complaints', 'complaintId');
        }

        public function insert(Complaint $complaint){
            $sql = "INSERT INTO {$this->table}(accountId, employeeId, townId, accountNum, landmark, complaintDesc, statusId, complaintDate, natureId)
                    VALUES (:accountId, :employeeId, :townId, :accountNum, :landmark, :complaintDesc, :statusId, :complaintDate, :natureId)";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(":accountId", $complaint->accountId);
            $stmt->bindParam(":employeeId", $complaint->employeeId);
            $stmt->bindParam(":townId", $complaint->townId);
            $stmt->bindParam(":accountNum", $complaint->accountNum);
            $stmt->bindParam(":landmark", $complaint->landmark);
            $stmt->bindParam(":complaintDesc", $complaint->complaintDesc);
            $stmt->bindParam(":statusId", $complaint->statusId);
            $stmt->bindParam(":complaintDate", $complaint->complaintDate);
            $stmt->bindParam(":natureId", $complaint->natureId);

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

        public function update(Complaint $complaint, $id){
            $sql = "UPDATE {$this->table} SET employeeId = :employeeId, statusId = :statusId, natureId = :natureId WHERE complaintId = :complaintId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":employeeId", $complaint->employeeId);
            $stmt->bindParam(":statusId", $complaint->statusId);
            $stmt->bindParam("natureId", $complaint->natureId);
            $stmt->bindParam("complaintId", $$id);

            return $stmt->execute();
        }

        public function updateByFilter($filter){
            die();
        }
    }