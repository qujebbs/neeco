<?php
        require_once __DIR__ . '/BaseRepo.php';
        require_once __DIR__ . '/../models/AccountModel.php';

        class AccountRepo extends BaseRepo{
            public function __construct() {
                parent::__construct('accounts', 'accountId');
            }
            public function insert($consumers){
                $sql = "INSERT INTO {$this->table}(accountId, consumerId, employeeId, userName, passwrord, positionId;, registrationDate, accountStatusId, verificationCode, isActive)
                        VALUES (:accountId, :consumerId, :employeeId, :userName, :passwrord, :positionId;, :registrationDate, :accountStatusId, :verificationCode, :isActive)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(":accountId", $consumers->accountId);
                $stmt->bindParam(":consumerId", $consumers->consumerId);
                $stmt->bindParam(":employeeId", $consumers->employeeId);
                $stmt->bindParam(":userName", $consumers->userName);
                $stmt->bindParam(":passwrord", $consumers->passwrord);
                $stmt->bindParam(":positionId", $consumers->positionId);
                $stmt->bindParam(":registrationDate", $consumers->registrationDate);
                $stmt->bindParam(":accountStatusId", $consumers->accountStatusId);
                $stmt->bindParam(":verificationCode", $consumers->verificationCode);
                $stmt->bindParam(":isActive", $consumers->isActive);
            }
            
            public function selectByFilter(AccountFilter $filter){
                $sql = "SELECT * FROM neeco2area1.dbo.accounts a
                        LEFT JOIN positions p on a.positionId = p.positionId
                        LEFT JOIN accountStatus ac on ac.accountStatusId = a.accountStatusId";

                $conditions = $filter->toSqlConditions();

                if (!empty($conditions)) {
                    $sql .= $conditions;
                }

                $stmt = $this->con->prepare($sql);

                if ($filter->accountId !== null) $stmt->bindParam(':accountId', $filter->accountId);
                if ($filter->consumerId !== null) $stmt->bindParam(':consumerId', $filter->consumerId);
                if ($filter->employeeId !== null) $stmt->bindParam(':employeeId', $filter->employeeId);
                if ($filter->username !== null) $stmt->bindParam(':username', $filter->username);
                if ($filter->positionId !== null) $stmt->bindParam(':positionId', $filter->positionId);
                if ($filter->accountStatusId !== null) $stmt->bindParam(':accountStatusId', $filter->accountStatusId);

                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
