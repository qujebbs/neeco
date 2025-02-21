<?php
    require_once("src/config/db.php");

    class Logger{
        private $con;
        public function __construct($con){
            $this->con = $con;
        }

        public function log($employeeId, $logActivity){
            try{
                $sql = "INSERT INTO logs(employeeId, logActivity) VALUES (:employeeId, :logActivity)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(":employeeId", $employeeId);
                $stmt->bindParam(":logActivity", $logActivity);

                $stmt->execute();
            } catch (Exception $e) {
                $logMessage = "[" . date('Y-m-d H:i:s') . "] Logging Failed: {$logActivity} - Error: {$e->getMessage()}\n";
                file_put_contents(__DIR__ . '/../logs/error_log.txt', $logMessage, FILE_APPEND);
            }
        }

        public function getLogs() {
            $stmt = $this->con->prepare("SELECT * FROM logs");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLogsByEmployeeId($employeeId){
            $stmt = $this->con->prepare("SELECT * FROM logs WHERE employeeId = :id");
            $stmt->bindParam(":id", $employeeId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }