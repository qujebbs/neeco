<?php 
include "models/award.model.php";
include "src/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

$id = 2;
$award = new Award($con);
$award->awardType = "n4s";
$award->awardName = "n3s";
$award->awardFrom = "n4ss";



$awards = $award->selectOne($id);

dumpVar($awards);