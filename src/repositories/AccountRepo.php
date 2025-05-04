<?php
    require_once __DIR__ . '/BaseRepo.php';
    require_once __DIR__ . '/../models/AccountModel.php';
    
    class AccountRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('accounts', 'accountId');
        }
        public function insert(Account $account){
            try{
                $sql = "INSERT INTO {$this->table}(consumerId, employeeId, userName, [password], positionId, accountStatusId, verificationCode, isActive, townId, email)
                        VALUES (:consumerId, :employeeId, :userName, :pass, :positionId, :accountStatusId, :verificationCode, :isActive, :townId, :email)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(":consumerId", $account->consumerId);
                $stmt->bindParam(":employeeId", $account->employeeId);
                $stmt->bindParam(":userName", $account->username);
                $stmt->bindParam(":pass", $account->password);
                $stmt->bindParam(":positionId", $account->positionId);
                $stmt->bindParam(":accountStatusId", $account->accountStatusId);
                $stmt->bindParam(":verificationCode", $account->verificationCode);
                $stmt->bindParam(":isActive", $account->isActive);
                $stmt->bindParam(":townId", $account->townId);
                $stmt->bindParam(":email", $account->email);

                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                error_log("Database Error: " . $e->getMessage());
                return false;
            }
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
        
        public function countByFilter(AccountFilter $filter){
            $sql = "SELECT a.accountStatusId AS acs, COUNT(*) AS count FROM neeco2area1.dbo.accounts a";

            $conditions = $filter->toSqlConditions();

            if (!empty($conditions)){
                $sql .= $conditions;
            }

            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall(PDO::FETCH_ASSOC);
        }

        public function updateStatus($status, $accountId){
            $sql = "UPDATE accounts SET accountStatusId = :statusId WHERE accountId = :accountId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":statusId", $status);
            $stmt->bindParam(":accountId", $accountId);
            
            return $stmt->execute();
        }

        public function findByEmail($email) {
            $sql = "SELECT * FROM accounts WHERE email = :email";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findByAccountId($id){
            $sql = "SELECT * FROM accounts WHERE accountId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public function updatePassword($id, $hashedPassword) {
            $sql = "UPDATE accounts SET [password] = :newPassword WHERE accountId = :accountId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":newPassword", $hashedPassword);
            $stmt->bindParam(":accountId", $id);

            return $stmt->execute();
        }
        
    }
