<?php
    require_once __DIR__ . '/../repositories/baseRepo.php';
    require_once __DIR__ . '/../filters/ComplaintFilters.php';
    require_once __DIR__ . '/../models/ComplaintModel.php';
    require_once __DIR__ . '/../models/ComplaintActionModel.php';
    class ComplaintRepo extends BaseRepo{
        public function __construct() {
            parent::__construct( 'complaints', 'complaintId');
        }
        public function insert(Complaint $complaint){
            if (empty($complaint->complaintDate)) {
                $complaint->complaintDate = date('Y-m-d H:i:s');
            }
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
                        LEFT JOIN 	neeco2area1.dbo.towns t ON c.townId=t.townId
                        LEFT JOIN 	neeco2area1.dbo.accounts a ON a.accountId=c.accountId
                        LEFT JOIN   neeco2area1.dbo.employees e ON e.employeeId=c.employeeId
                        LEFT JOIN   neeco2area1.dbo.complaintStatus s ON s.statusId=c.statusId
                        LEFT JOIN 	neeco2area1.dbo.complaintNatures cn2 ON cn2.natureId=c.natureId";

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
                if ($filter->townId !== null) $stmt->bindParam(':townId', $filter->townId);
                
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function update(Complaint $complaint, $id){
            $sql = "UPDATE {$this->table} SET employeeId = :employeeId, statusId = :statusId, natureId = :natureId, complaintDesc = :complaintDesc WHERE complaintId = :complaintId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":employeeId", $complaint->employeeId);
            $stmt->bindParam(":statusId", $complaint->statusId);
            $stmt->bindParam(":natureId", $complaint->natureId);
            $stmt->bindParam(":complaintDesc", $complaint->complaintDesc);
            $stmt->bindParam(":complaintId", $id);

            return $stmt->execute();
        }
        public function countByFilter(ComplaintFilter $filter){
            $sql = "SELECT c.statusId as cs, COUNT(*) AS count FROM complaints c";

            $conditions = $filter->toSqlConditions();

            if (!empty($conditions)){
                $sql .= $conditions;
            }

            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall(PDO::FETCH_ASSOC);
        }
        public function updateByFilter($filter){
            die();
        }

        public function getComplaintNatures(){
            $sql = "SELECT * FROM complaintNatures";
            $stmt = $this->con->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getComplaintByMonth(){
            $sql = "SELECT 
                        FORMAT(endDate, 'MMM') AS ComplaintMonth,
                        COUNT(*) AS TotalComplaints
                    FROM 
                        neeco2area1.dbo.complaintAction
                    WHERE 
                        YEAR(endDate) = YEAR(GETDATE())
                    GROUP BY
                        FORMAT(endDate, 'MMM')
                    ORDER BY 
                        ComplaintMonth";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getComplaintCountByTown(){
            $sql = "SELECT 
                        COUNT(*) AS Total,
                         t.townDesc AS TownName
                    FROM 
                        neeco2area1.dbo.complaints c
                    JOIN 
                        neeco2area1.dbo.towns t ON c.townId = t.townId
                    GROUP BY 
                        t.townDesc, t.townId
                    ORDER BY 
                        t.townId";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function markAsSolved(ComplaintAction $action, &$error = null){

            $this->con->beginTransaction();
            try {
                $insertSql="INSERT INTO neeco2area1.dbo.complaintAction (complaintId, actionDetails, startDate, endDate, employeeId)
                            VALUES (:complaintId, :actionDetails, :startDate, :endDate, :employeeId)";
                $stmt = $this->con->prepare($insertSql);
                
                $stmt->bindParam(":complaintId", $action->complaintId);
                $stmt->bindParam(":actionDetails", $action->actionDetails);
                $stmt->bindParam(":startDate", $action->startDate);
                $stmt->bindParam(":endDate", $action->endDate);
                $stmt->bindParam(":employeeId", $action->employeeId);

                $stmt->execute();

                $updateSql = "UPDATE neeco2area1.dbo.complaints SET statusId = 3 WHERE complaintId = :complaintId";
                $stmt = $this->con->prepare($updateSql);
                $stmt->bindParam(":complaintId", $action->complaintId);

                $stmt->execute();

                $this->con->commit();
                return true;
            }catch (PDOException $e) {
                $this->con->rollBack();
                $error = $e->getMessage();
                return false;
            }
        }
    }