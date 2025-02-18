<?php 
include "logs/logger.php";
include "utils/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

$id = 2;
$award = new Award($con);
$award->pdfName = "test";
$award->pdfTitle = "ing";


$awards = $award->insert();

$log = new Logger($con);
$logs = $log->log(
    $id,
    "nuw"
);

dumpVar($logs);