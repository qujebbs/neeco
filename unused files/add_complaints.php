<?php
include "sidebar.php";


?>

<!DOCTYPE html>
<html lang="en">

<?php include "views/fragments/metadata.php"; ?>

<!-- <div class="container-fluid"> -->

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Add Complaints</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Complain </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                   


<div class="form-group">
    <label for="account_num">Account No:</label>
    <input type="text" class="form-control" id="account_num" name="account_num" required>
</div>



<div class="form-group">
    <label for="landmark">Landmark:</label>
    <input type="text" class="form-control" id="landmark" name="landmark" required>
</div>
<div class="form-group">
    <label for="meter_srn">Meter S/N:</label>
    <input type="text" class="form-control" id="meter_srn" name="meter_srn" required>
</div>
<div class="form-group">
    <label for="pole_id">Pole No:</label>
    <input type="text" class="form-control" id="pole_id" name="pole_id" required>
</div>
<div class="form-group">
    <label for="complain_desc">Complaint Details:</label>
    <textarea class="form-control" name="complain_desc" id="complain_desc" placeholder="Enter complaint details"></textarea>
</div>

<button type="submit" name="addcomplainbtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'src/init.php';
$allComplaints = $qrys->select_one('complaint_tbl', array('consumer_id', '=', $consumer_id)); 

if (isset($_POST['addcomplainbtn'])) {
    $complainantaccount_num = $strip->strip($_POST['account_num']);
    $complainDetails = $strip->strip($_POST['complain_desc']);
    $landmark = $strip->strip($_POST['landmark']);
    $meter_srn = $strip->strip($_POST['meter_srn']); 
    $pole_id = $strip->strip($_POST['pole_id']); 
    $status = 0;
    
    $sql = "SELECT * FROM consumer_tbl WHERE account_num = '$complainantaccount_num' ";


            foreach (mysqli_query($con, $sql) as $row) {
                $consumerid = $row['consumer_id'];
                $town_id = $row['town_id'];
    }

    if($town_id == 1){
        $emp_id = 5;
    }
    if($town_id == 2){
        $emp_id = 6;
    }
    if($town_id == 3){
        $emp_id = 7;
    }
    if($town_id == 4){
        $emp_id = 8;
    }
    if($town_id == 5){
        $emp_id = 9;
    }
    if($town_id == 6){
        $emp_id = 10;
    }
    if($town_id == 7){
        $emp_id = 11;
    }
    if($town_id == 8){
        $emp_id = 12;
    }
    if($town_id == 9){
        $emp_id = 13;
    }
    if($town_id == 10){
        $emp_id = 14;
    }

    $complaintInsert = $qrys->insert('complaint_tbl', array(
        'consumer_id' => $consumerid,
        'account_num' => $complainantaccount_num,
        'pole_id' => $pole_id,
        'meter_srn' => $meter_srn,
        'landmark' => $landmark,
        'complaint_desc' => $complainDetails,
        'complaint_status' => $status,
        'town_id' => $town_id,
        'employee_id' => $emp_id
       
    ));
    $lastinsert = mysqli_insert_id($con);
          
    $_SESSION['complain_id'] = $lastinsert;
    
    if ($complaintInsert) {
        echo '<script> swal.fire({
            icon: "success",
            title: "Successfully Submitted!",
            text: "Your concern/request reference No. is '.$lastinsert.'. You may track your request status on Form Request List"
        });
        </script>';
        header("refresh:1;");
    }
}
?>


<?php 

function get_empcomplain_history($consumer_id) {
    global $con;
    $list = array();

    $sql = "SELECT consumer_tbl.consumer_id, consumer_tbl.firstname, consumer_tbl.profilepix, consumer_tbl.lastname, consumer_tbl.account_num, consumer_tbl.barangay, consumer_tbl.email, complaint_tbl.landmark, complaint_tbl.meter_srn, complaint_tbl.pole_id, complaint_tbl.complaint_desc, complaint_tbl.complaint_status, town_tbl.town_name
         FROM consumer_tbl
         INNER JOIN complaint_tbl ON consumer_tbl.consumer_id = complaint_tbl.consumer_id
         INNER JOIN town_tbl ON consumer_tbl.town_id = town_tbl.town_id
         WHERE complaint_tbl.consumer_id = '$consumer_id'";


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


$complainhistory = get_complain_history($consumer_id);
?>


            
          




</div>


</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include 'views/fragments/tableFooter.php'; ?>

</body>

</html>