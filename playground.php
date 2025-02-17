<?php 
include "logs/logger.php";
include "src/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

// $id = 2;
// $award = new Downloads($con);
// $award->pdfName = "test";
// $award->pdfTitle = "ing";


// $awards = $award->insert();

$log = new Logger($con);
$logs = $log->getLogsByEmployeeId(2);

dumpVar($logs);