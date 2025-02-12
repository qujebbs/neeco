<?php

    include "src/db.php";
    function insertLog($employeeId, $logActivity, $con)
    {
        try {
    
            $sql = "INSERT INTO logs (employeeId, logActivity) VALUES (:employeeId, :logActivity)";
            
            $stmt = $con->prepare($sql);

            $stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_STR);
            $stmt->bindParam(':logActivity', $logActivity, PDO::PARAM_STR);

            $stmt->execute();
    
            echo "Record inserted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    