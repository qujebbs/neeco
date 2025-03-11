<?php
        require_once 'BaseRepo.php';
        require_once 'src/models/AccountModel.php';

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
            
            public function select(){

            }
        }