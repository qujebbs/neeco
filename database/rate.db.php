<?php
    include "src/db.php";

    function insertRate($con, $rate){
        $sql = "INSERT INTO rates (pdf, date, rateType) VALUES (:pdf, :date, rateType)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':pdf', $rate->pdf);
        $stmt->bindParam(':date', $rate->date);
        $stmt->bindParam(':rateType', $rate->rateType);

        return $stmt->execute();
    }

    function selectRates($con){
        $stmt = $con->prepare("SELECT * FROM rates");
        $stmt->execute();

        $result = $stmt->fetchall(PDO :: FETCH_ASSOC);

        return $result;
    }

    function deleteRate($con, $rateId){

    }