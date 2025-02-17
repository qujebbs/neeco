<?php 
include "models/award.models.php";
include "src/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

$id = 2;
$award = new Award($con);
$award->awardType = "test";
$award->awardName = "ing";
$award->awardFrom = "n4ss";



$awards = $award->update($id);

dumpVar($awards);