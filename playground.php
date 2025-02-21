<?php
include "src/repositories/TownsRepo.php";
include "utils/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

// $filter = new ComplaintFilter([
//     'statusId' => 1
// ]);

$complaintModel = new TownsRepo($con);
$filteredComplaints = $complaintModel->selectAll();

dumpVar($filteredComplaints);