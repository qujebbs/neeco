<?php
    require_once 'BaseRepo.php';
    require_once 'src/models/ConsumerModel.php';

    class ConsumerRepo extends BaseRepo{
            public function __construct() {
                parent::__construct('consumers', 'consumerId');
            }
        
            public function insert(Consumer $consumer) {
                $sql = 'INSERT INTO {$this->table} 
                (townId, routeCode, accountNum, lastName, firstName, midName, suffix, barangay, profilepix, backpix, registrationDate, poleId, meterSRN, employeeName, [date], [time], transferrable, email) VALUES
                (:townId, :routeCode, :accountNum, :lastName, :firstName, :midName, :suffix, :barangay, :profilepix, :backpix, :registrationNum, :poleId, :meterSRN, :employeeName, :date, :time, :transferrable, :email)';
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':townId', $consumer->townId);
                $stmt->bindParam(':routeCode', $consumer->routeCode);
                $stmt->bindParam(':accountNum', $consumer->accountNum);
                $stmt->bindParam(':lastName', $consumer->lastName);
                $stmt->bindParam(':firstName', $consumer->firstName);
                $stmt->bindParam(':midName', $consumer->midName);
                $stmt->bindParam('suffix', $consumer->suffix);
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

            public function selectByFilters(ConsumerFilter $filters){
                $sql = "SELECT * FROM neeco2area1.dbo.consumers c LEFT JOIN 	towns t ON c.townId=t.townId WHERE consumerId = :consumerId";

                $conditions = $filters->toSqlConditions();
        
                if (!empty($conditions)) {
                    $sql .= $conditions;
                }

                $stmt = $this->con->prepare($sql);

                if ($filters->accountId !== null) $stmt->bindParam(':accountId', $filters->accountId);
                if ($filters->consumerId !== null) $stmt->bindParam(':consumerId', $filters->consumerId);
                if ($filters->statusId !== null) $stmt->bindParam(':statusId', $filters->statusId);
                if ($filters->townId !== null) $stmt->bindParam(':townId', $filters->townId);

                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            public function update(Consumer $consumer){
                die();
            }
    }