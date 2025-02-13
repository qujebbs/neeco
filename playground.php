<?php 
include "models/rate.model.php";
include "src/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

$rate = new Rate($con);
$rate->pdf = "route";
$rate->date = date("2002-12-12");
$rate->rateType = "idk";

$rate->insert();