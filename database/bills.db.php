<?php
    include "src/db.php";
    
    
    function insertBills($csvFile, $con)
    {
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
            return true;
        } else {
            echo "Error opening file!";
            return false;
        }
    }

    function selectBills($con) {
        $list = array();
    
        $sql = "SELECT *
             FROM consumer_tbl
             INNER JOIN bill_tbl ON consumer_tbl.consumer_id = bill_tbl.consumer_id
             INNER JOIN town_tbl ON consumer_tbl.town_id = town_tbl.town_id
             ";
    
        $qry = $con->query($sql);
    
        $rowcount = mysqli_num_rows($qry);
    
        if ($rowcount != 0) {
            for ($x = 1; $x <= $rowcount; $x++) {
                $row = mysqli_fetch_assoc($qry);
                $list[] = $row;
            }
            return $list;
        }
        return null;
    }

    function deleteBill($billId, $con)
    {
        try {

            $sql = "DELETE FROM Users WHERE billId = :billId";

            $stmt = $con->prepare($sql);

            $stmt->bindParam(':billId', $billId, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
               return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function updateBill($pdo, $bill) {
        $sql = "UPDATE bill_tbl SET 
                    bill_amount = :billAmount, 
                    bill_yrmonth = :billYearMonth, 
                    kwh_used = :kwhUsed, 
                    or_amount = :orAmount, 
                    due_date = :dueDate 
                WHERE bill_id = :billID";
    
        $stmt = $pdo->prepare($sql);
    

        $stmt->bindParam(':billId', $bill->billID);
        $stmt->bindParam(':billAmount', $bill->billAmount);
        $stmt->bindParam(':billYearMonth', $bill->billYrMonth);
        $stmt->bindParam(':kwhUsed', $bill->kwhUsed);
        $stmt->bindParam(':orAmount', $bill->orAmount);
        $stmt->bindParam(':dueDate', $bill->dueDate);
    
        return $stmt->execute();
    }