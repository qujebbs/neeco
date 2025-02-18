
<?php
include "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php include "views/fragments/metadata.php"; ?>

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Add Bills</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Billing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
    <input type="file" name="billsCSV">
    <input type="submit" name="submit">

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['billsCSV'])) {
    $con = mysqli_connect("localhost", "root", "", "neecollarea1");
    // global $con;

    if ($con) {
        $textFileContent = file_get_contents($_FILES['billsCSV']['tmp_name']);
        $rows = explode("\n", $textFileContent);
        $tableName = 'bill_tbl';

        for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
            $rowData = $rows[$rowIndex];

            if (empty($rowData)) {
                continue;
            }

            $values = str_getcsv($rowData, ',');
            $values = array_map('trim', $values);

            $insertDataQuery = "INSERT INTO $tableName VALUES (";

            foreach ($values as $cell) {
                $insertDataQuery .= "'$cell', ";
            }

            $insertDataQuery = rtrim($insertDataQuery, ', ') . ');';

            if (mysqli_query($con, $insertDataQuery)) {
        // if (sqlsrv_query($con, $insertDataQuery)) {
                $emp_id = $peracc[0]['employee_id'];
                $sql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$emp_id', 'add billing')";
                $result =mysqli_query($con, $sql);
            // $result =mysqli_query($con, $sql);        
            } if($result) {
                echo "Data inserted successfully into the '$tableName' table.<br>";
            }else {
                echo "Error inserting data: " . mysqli_error($con) . "<br>";
                // echo "Error inserting data: " . sqlsrv_error($con) . "<br>";
            }
        }
    } else {
        echo "Error connecting to the database.<br>";
    }
}
?>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 

function get_your_bill() {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN bill_tbl ON consumer_tbl.consumer_id = bill_tbl.consumer_id
         INNER JOIN town_table ON consumer_tbl.town_code = town_table.town_code
         ";

    $qry = $con->query($sql);

    $rowcount = mysqli_num_rows($qry);

    if ($rowcount != 0) {
        for ($x = 1; $x <= $rowcount; $x++) {
            $row = mysqli_fetch_assoc($qry);
            $list[] = $row;
        }
        return $list;
    }
    return null;
}
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Kwh Used</th>
                    <th>Current Bill</th>
                    <th>Bill YR/Month</th>
                    <th>DueDate</th>
                    <th>OR Amount</th>
                    <th>OR date</th>
                    <th>Disconnection Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Kwh Used</th>
                    <th>Current Bill</th>
                    <th>Bill YR/Month</th>
                    <th>DueDate</th>
                    <th>OR amount</th>
                    <th>OR date</th>
                    <th>Disconnection Date</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        $consumer_id = $_SESSION['consumerid'];  

                        $consumerBills = get_your_bill($consumer_id);

                        if ($consumerBills) {
                            foreach ($consumerBills as $bill) : ?>
                                <tr>
                                    
                                
                        <td><?= $bill['firstname']; ?> <?= $bill['lastname']; ?></td>
                        <td><?= $bill['account_num']; ?></td>
                        <td><?= $bill['town_name']; ?>, <?= $bill['barangay']; ?></td>
                        <td><?= $bill['kwh_used']; ?></td>
                        <td><?= $bill['bill_amount']; ?></td>
                        <td><?= date('F j, Y', strtotime($bill['bill_yrmonth'])); ?></td>
                        <td><?= date('F j, Y', strtotime($bill['due_date'])); ?></td>
                        <td><?= $bill['or_amount']; ?></td>
                        <td><?= date('F j, Y', strtotime($bill['or_date'])); ?></td>
                        <td><?= date('F j, Y', strtotime($bill['disconnection_date'])); ?></td>

                        <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewModal<?= $bill['bill_id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<div class="modal fade" id="viewModal<?= $bill['bill_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel<?= $bill['bill_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel<?= $bill['bill_id']; ?>">Add Complain </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                   

                    <input type="hidden" class="form-control" id="bill_id" name="bill_id" value="<?= $bill['bill_id']; ?>">

<div class="form-group">
    <label for="bill_amount">Bill Amount:</label>
    <input type="text" class="form-control" id="bill_amount" name="bill_amount" value="<?= $bill['bill_amount']; ?>">
</div>



<div class="form-group">
    <label for="bill_yrmonth">Bill Year/Month:</label>
    <input type="date" class="form-control" id="bill_yrmonth" name="bill_yrmonth" value="<?= $bill['bill_yrmonth']; ?>">
</div>

<div class="form-group">
    <label for="kwh_used">Kilowatts Used:</label>
    <input type="text" class="form-control" id="kwh_used" name="kwh_used" value="<?= $bill['kwh_used']; ?>">
</div>

<div class="form-group">
    <label for="or_amount">OR Amount:</label>
    <input type="text" class="form-control" id="or_amount" name="or_amount" value="<?= $bill['or_amount']; ?>">
</div>

<div class="form-group">
    <label for="duedate">DueDate:</label>
    <input type="date" class="form-control" id="duedate" name="duedate" value="<?= $bill['due_date']; ?>">
</div>

<button type="submit" name="editbillbtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $bill['bill_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $bill['bill_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $bill['bill_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $bill['bill_id']; ?>">Delete Consumer Bills </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                   Are you sure want to delete this bill? This action cannot be undone

                    <input type="hidden" class="form-control" id="bill_id" name="bill_id" value="<?= $bill['bill_id']; ?>">


<div class="modal-footer">
<button type="submit" name="dltbillbtn" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







            </td>
                                </tr>
                        <?php endforeach;
                        } else {
                            echo '<tr><td colspan="5">No data available</td></tr>';
                        }
                        ?>
                    </tbody>

        </table>
    </div>
</div>
</div>
<?php
include 'src/init.php';


if (isset($_POST['dltbillbtn'])) {
    $billID = $strip->strip($_POST['bill_id']);
    
    $sql = "DELETE FROM bill_tbl WHERE bill_id = '$billID'";
    $result = mysqli_query($con, $sql);
// $result = sqlsrv_query($con, $sql);
    if($result){
        $emp_id = $peracc[0]['employee_id'];
        
        $loginsert = $qrys->insert('logs_tbl', array(
            'employee_id' => $emp_id,
            'log_activity' => 'DeleteBills'
        ));
        if($loginsert){

            echo' <script> swal.fire({
                    icon: "success",
                   title: "Change has been Saved!",
                   text: "Click ok to refresh the page.",
                   type: "success"
                 }).then(function(){
                   window.location="add_billing.php";
                 });
                 </script>';

         } 
    }
}
?>

<?php
include 'src/init.php';


if (isset($_POST['editbillbtn'])) {
    $billID = $strip->strip($_POST['bill_id']);
    $billamount = $strip->strip($_POST['bill_amount']);
    $billyrmonth = $strip->strip($_POST['bill_yrmonth']);
    $kwh_used = $strip->strip($_POST['kwh_used']); 
    $or_amount = $strip->strip($_POST['or_amount']); 
    $duedate = $strip->strip($_POST['duedate']); 
    
    $sql = "UPDATE bill_tbl SET bill_amount = '$billamount', bill_yrmonth = '$billyrmonth', kwh_used = '$kwh_used', or_amount = '$or_amount', due_date = '$duedate' WHERE bill_id = '$billID'";
    $result = mysqli_query($con, $sql);
    // $result = sqlsrv_query($con, $sql);

    if($result){
        $emp_id = $peracc[0]['employee_id'];
        
        $loginsert = $qrys->insert('logs_tbl', array(
            'employee_id' => $emp_id,
            'log_activity' => 'EditBills'
        ));
        if($loginsert){

            echo' <script> swal.fire({
                    icon: "success",
                   title: "Change has been Saved!",
                   text: "Click ok to refresh the page.",
                   type: "success"
                 }).then(function(){
                   window.location="add_billing.php";
                 });
                 </script>';

         } 
    }
}
?>


</div>


</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include 'views/fragments/tableFooter.php'; ?>

</body>

</html>