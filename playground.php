<?php
include "src/repositories/ComplaintRepo.php";
include "utils/debugUtil.php";


$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

$filter = new ComplaintFilter([
    'statusId' => 1
]);

$complaintModel = new ComplaintRepo($con);
$filteredComplaints = $complaintModel->selectByFilter($filter);

// dumpVar($filteredComplaints);
echo $filteredComplaints[0]['complaintId'];