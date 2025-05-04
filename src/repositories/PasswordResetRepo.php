<?php
    class PasswordResetRepo extends BaseRepo{

        public function __construct() {
            parent::__construct('passwordResets', 'id');
        }
        public function storeToken($accountId, $token, $expiresAt) {
            $sql = "INSERT INTO passwordResets (accountId, token, expiresAt) 
                    VALUES (:accountId, :token, :expiresAt)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":accountId", $accountId);
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":expiresAt", $expiresAt);

            $stmt->execute();
        }

        public function getByToken($token) {
            $sql = "SELECT * FROM passwordResets WHERE token = :token";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":token", $token);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteToken($token) {
            $sql = "DELETE FROM passwordResets WHERE token = :token";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":token", $token);
            $stmt->execute();
        }
    }
