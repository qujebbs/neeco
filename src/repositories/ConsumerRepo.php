<?php
    require_once __DIR__ . '/BaseRepo.php';
    require_once __DIR__ . '/../models/ConsumerModel.php';
    require_once __DIR__ . '/../filters/ConsumerFilters.php';

    class ConsumerRepo extends BaseRepo{
            public function __construct() {
                parent::__construct('consumers', 'consumerId');
            }
        
            public function insert(Consumer $consumer) {
                $sql = 'INSERT INTO {$this->table} 
                (townId, routeCode, accountNum, lastname, firstname, midname, suffix, barangay, profilepix, backpix, registrationDate, poleId, meterSRN, employeeName, [date], [time], transferrable, email) VALUES
                (:townId, :routeCode, :accountNum, :lastname, :firstname, :midname, :suffix, :barangay, :profilepix, :backpix, :registrationNum, :poleId, :meterSRN, :employeeName, :date, :time, :transferrable, :email)';
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':townId', $consumer->townId);
                $stmt->bindParam(':routeCode', $consumer->routeCode);
                $stmt->bindParam(':accountNum', $consumer->accountNum);
                $stmt->bindParam(':lastname', $consumer->lastname);
                $stmt->bindParam(':firstname', $consumer->firstname);
                $stmt->bindParam(':midname', $consumer->midname);
                $stmt->bindParam(':suffix', $consumer->suffix);
                $stmt->bindParam(':barangay', $consumer->barangay);
                $stmt->bindParam(':profilepix', $consumer->profilepix);
                $stmt->bindParam(':backpix', $consumer->backpix);
                $stmt->bindParam(':registrationDate', $consumer->registrationDate);
                $stmt->bindParam(':poleId', $consumer->poleId);
                $stmt->bindParam(':meterSRN', $consumer->meterSRN);
                $stmt->bindParam(':employeeName', $consumer->employeeName);
                $stmt->bindParam(':date', $consumer->date);
                $stmt->bindParam(':time', $consumer->time);
                $stmt->bindParam(':transferrable', $consumer->transferrable);
                $stmt->bindParam(':email', $consumer->email);

                return $stmt->execute();
            }
            
            public function selectByFilters(ConsumerFilter $filters, $limit = 1000, $offset = 0) {
                $limit = (int)$limit;
                $offset = (int)$offset;

                $sql = "SELECT * FROM neeco2area1.dbo.consumers c
                        LEFT JOIN accounts a ON c.consumerId = a.consumerId
                        LEFT JOIN accountStatus ac ON ac.accountStatusId = a.accountStatusId";
            
                $conditions = $filters->toSqlConditions();
            
                if (!empty($conditions)) {
                    $sql .= $conditions;
                }
            
                $sql .= " ORDER BY a.accountId OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
            
                $stmt = $this->con->prepare($sql);

                if ($filters->accountId !== null) $stmt->bindParam(':accountId', $filters->accountId);
                if ($filters->consumerId !== null) $stmt->bindParam(':consumerId', $filters->consumerId);
                if ($filters->statusId !== null) $stmt->bindParam(':accountStatusId', $filters->statusId);
                if ($filters->townId !== null) $stmt->bindParam(':townId', $filters->townId);
                if ($filters->accountNum !== null) $stmt->bindParam(':accountNum', $filters->accountNum);
                
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                // return $stmt->debugDumpParams();
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            public function countByFilters(ConsumerFilter $filters) {
                $sql = "SELECT COUNT(*) AS total 
                        FROM neeco2area1.dbo.consumers c
                        RIGHT JOIN accounts a ON c.consumerId = a.consumerId
                        INNER JOIN accountStatus ac ON ac.accountStatusId = a.accountStatusId";
            
                $conditions = $filters->toSqlConditions();
            
                if (!empty($conditions)) {
                    $sql .= $conditions;
                }
            
                $stmt = $this->con->prepare($sql);
            
                if ($filters->accountId !== null) $stmt->bindParam(':accountId', $filters->accountId);
                if ($filters->consumerId !== null) $stmt->bindParam(':consumerId', $filters->consumerId);
                if ($filters->statusId !== null) $stmt->bindParam(':accountStatusId', $filters->statusId);
                if ($filters->townId !== null) $stmt->bindParam(':townId', $filters->townId);
            
                $stmt->execute();
                return $stmt->fetchColumn(); // Efficient way to retrieve a single value
            }
            
            
            // public function selectByFilters(ConsumerFilter $filters){
            //     $sql = "SELECT TOP {$this->limit} * FROM neeco2area1.dbo.consumers c
            //             RIGHT JOIN accounts a ON c.consumerId=a.consumerId
            //             INNER JOIN accountStatus ac ON ac.accountStatusId=a.accountStatusId";

            //     $conditions = $filters->toSqlConditions();
        
            //     if (!empty($conditions)) {
            //         $sql .= $conditions;
            //     }

            //     $stmt = $this->con->prepare($sql);

            //     if ($filters->accountId !== null) $stmt->bindParam(':accountId', $filters->accountId);
            //     if ($filters->consumerId !== null) $stmt->bindParam(':consumerId', $filters->consumerId);
            //     if ($filters->statusId !== null) $stmt->bindParam(':accountStatusId', $filters->statusId);
            //     if ($filters->townId !== null) $stmt->bindParam(':townId', $filters->townId);

            //     $stmt->execute();
            //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // }

            public function update(Consumer $consumer, $id){
                $sql = "UPDATE {$this->table} SET lastname = :lastname, firstname = :firstname, midname = :midname, suffix = :suffix, barangay = :barangay, profilepix = :profilepix, backpix = :backpix WHERE consumerId = :id";
                $stmt = $this->con->prepare($sql);
                
                $stmt->bindParam(":lastname", $consumer->lastname);
                $stmt->bindParam(":firstName", $consumer->firstname);
                $stmt->bindParam("midName", $consumer->midname);
                $stmt->bindParam(":suffix", $consumer->suffix);
                $stmt->bindParam(":barangay", $consumer->barangay);
                $stmt->bindParam(":profilepix", $consumer->profilepix);
                $stmt->bindParam(":backpix", $consumer->backpix);
                $stmt->bindParam(":id", $id);

                return $stmt->execute();
            }
    }