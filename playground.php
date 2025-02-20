<?php
include "models/bill.models.php";
include "utils/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

$id = 2;
$award = new Bill($con);
$award->limit = 1;

$awards = $award->selectWithJoin(1);

dumpVar($awards);