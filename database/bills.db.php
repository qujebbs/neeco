<?php
    include "src/db.php";
    function insertBills($csvFile, $con)
    {

        // Open CSV file
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            // fgetcsv($handle); Skip the header row

            $sql = "INSERT INTO bills (consumerId, billYearMonth, billAmount, kwhUsed, orDate, orAmount, dueDate, disconnectionDate) VALUES (:consumerId, :billYearMonth, :billAmount, :kwhUsed, :orDate, :orAmount, :dueDate, :disconnectionDate)";
            $stmt = $con->prepare($sql);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $stmt->bindParam(':consumerId', $data[0], PDO::PARAM_STR);
                $stmt->bindParam(':billYearMonth', $data[1], PDO::PARAM_STR);
                $stmt->bindParam(':billAmount', $data[2], PDO::PARAM_STR);
                $stmt->bindParam(':kwhUsed', $data[3], PDO::PARAM_STR);
                $stmt->bindParam(':orDate', $data[4], PDO::PARAM_STR);
                $stmt->bindParam(':orAmount', $data[5], PDO::PARAM_STR);
                $stmt->bindParam(':dueDate', $data[6], PDO::PARAM_STR);
                $stmt->bindParam(':disconnectionDate', $data[7], PDO::PARAM_STR);
                $stmt->execute();
            }

            fclose($handle);
            echo "CSV data inserted successfully!";
        } else {
            echo "Error opening file!";
        }
    }