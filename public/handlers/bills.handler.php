<?php 
    include "database/bills.db.php";
    include "utils.php";
    include "handlers/bills.handlers.php";


    function getBills(){
        die();
    }
    //no logs yet
    function addBills($con){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["billsCSV"])) {
            $fileTmpPath = $_FILES["billsCSV"]["tmp_name"];
            if (file_exists($fileTmpPath)) {
                $isAdded = insertBills($fileTmpPath, $con);
            } else {
                echo "File upload failed!";
                $isAdded = false;
            }
            if($isAdded){
                die();
            }
        }
    }
    
    //no logs yet
    function deleteBill($con ){
        if (isset($_POST['dltbillbtn'])) {
            $billId = sanitize_input($_POST['bill_id'], $con);
            $isDeleted = deleteBill($billId, $con);

            if ($isDeleted){
                die();
            }
        }
    }
    //no logs yet
    //include the model in the views
    function editBill($con){
        if (isset($_POST['editbillbtn'])) {

            $bill = new Bill($_POST['bill_id'], $_POST['bill_amount'], $_POST['bill_yrmonth'], $_POST['kwh_used'], $_POST['or_amount'], $_POST['duedate']);

            $isUpdated = updateBill($con, $bill);

            if ($isUpdated) {
                die();
            }
        }
}