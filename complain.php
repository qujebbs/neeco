<?php
include "sidebar.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Webpage</title>
  
  <link href="https://cdn.datatables.net/v/dt/dt-2.0.1/datatables.min.css" rel="stylesheet">
    
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">

    <!-- Include RowReorder CSS via CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.min.css">

    <!-- Include Responsive DataTables CSS via CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.dataTables.min.js"></script>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<div class="container-fluid">

<!-- Page Heading -->

<?php 

function get_complain_history($consumer_id) {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN complaint_tbl ON consumer_tbl.consumer_id = complaint_tbl.consumer_id
         INNER JOIN town_table ON consumer_tbl.town_code = town_table.town_code
         WHERE complaint_tbl.consumer_id = '$consumer_id' AND complaint_status = 0 order by complaint_tbl.complain_id DESC";


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
<!-- DataTales Example -->

<!-- DataTales Example -->
<?php
$complainhistory = get_complain_history($consumer_id);
?>

<?php 

function get_consumer_address($consumer_id) {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN town_table ON consumer_tbl.town_code = town_table.town_code
         WHERE consumer_tbl.consumer_id = '$consumer_id'";


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


$consumeraddress = get_consumer_address($consumer_id);
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Complain Now</h6>
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
                    <input type="hidden" name="consumer_id" id="consumer_id" value="<?php echo $peracc[0]['consumer_id']; ?>">

<div class="form-group">
    <label for="complain_details">Name: <?php echo  $peracc[0]['firstname']." ".$peracc[0]['lastname']; ?></label> <br>
    <label for="complain_details">Account No:  <?php echo $peracc[0]['account_num']; ?></label> <br>
    <label for="complain_details">Pole No:  <?php echo $peracc[0]['pole_id']; ?></label> <br>
    <label for="complain_details">Pole No:  <?php echo $peracc[0]['meter_srn']; ?></label> <br>
    <label for="complain_details">Complainant Address:<?php echo $peracc[0]['barangay'] .",".$consumeraddress[0]['town_description'].",". $peracc[0]['town_code'].",".$consumeraddress[0]['town_abbrev']; ?></label> <br>

</div>

<div class="form-group">
    
</div>


<div class="form-group">
    <label for="landmark">Landmark:</label>
    <input type="text" class="form-control" id="landmark" name="landmark" required>
</div>

<div class="form-group">
    
    <input type="text" class="form-control" id="town_id" name="town_id" value=<?php echo $peracc[0]['town_code'];?>>
</div>

<div class="form-group">
    
    <input type="text" class="form-control" id="route_code" name="route_code" value=<?php echo $peracc[0]['route_code'];?>>
</div>

<div class="form-group">
    <input type="text" class="form-control" id="account_num" name="account_num" value=<?php echo $peracc[0]['account_num'];?>>
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
    $complainDetails = $strip->strip($_POST['complain_desc']);
    $account_num = $strip->strip($_POST['account_num']);
    $consumerId = $strip->strip($_POST['consumer_id']);
    $landmark = $strip->strip($_POST['landmark']);
    $status = 0;
    $route_code = $strip->strip($_POST['route_code']);
    
    $town_id = $strip->strip($_POST['town_id']);

    $sql = "SELECT * FROM emp_tbl WHERE town_code = '$town_id' AND pos_id = 7";
    $result = mysqli_query($con, $sql);
    $emp = mysqli_fetch_assoc($result);
    $emp_id = $emp['employee_id'];

    $complaintInsert = $qrys->insert('complaint_tbl', array(
        'consumer_id' => $consumerId,
        'landmark' => $landmark,
        'complaint_desc' => $complainDetails,
        'complaint_status' => $status,
        'town_code' => $town_id,
        'account_num' => $account_num,
        'employee_id' => $emp_id,
       
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





            
          
<label for="complain_details">Name: <?php echo  $peracc[0]['firstname']." ".$peracc[0]['lastname']; ?></label> <br>
    <label for="complain_details">Account No:  <?php echo $peracc[0]['account_num']; ?></label> <br>
    <label for="complain_details">Complainant Address:<?php echo $peracc[0]['barangay'] .",".$consumeraddress[0]['town_description'].",".$consumeraddress[0]['town_abbrev']; ?></label> <br>
<div class="card-body">
    <div class="table-responsive" style="overflow-x:auto">
        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>Complain No.</th>
                    <th>Landmark</th>
                    <th>Pole No.</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Complain No.</th>
                    <th>Landmark</th>
                    <th>Pole No.</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
            <tbody>
                        <?php
                      

                        $complainhistory = get_complain_history($consumer_id);

                        if ($complainhistory) {
                            foreach ($complainhistory as $complain) : ?>
                                <tr>
                                <td><?= $complain['complain_id']; ?></td>
                                    <td><?= $complain['landmark']; ?></td>
                                    <td><?= $complain['pole_id']; ?></td>
                                    <td><?= $complain['complaint_desc']; ?></td>
                                    <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
</td>
                                    
                                    <td>


                                    <?php if ($complain['complaint_status'] == 0) : ?>
    <a href="edit-complain.php?complain_id=<?= $complain['complain_id']; ?>" class="btn btn-success btn-xl">
        <i class="fas fa-edit"></i>
    </a>
                                    </td>
                                    <td>
    <form method="post" action="delete_complaint.php">
        <button type="button" style="color: red; font-size: 15px;" class="form-control my-2" onclick="confirmSubmit(this.form, '<?php echo $complain['complain_id']; ?>')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
                                    </td>
<?php endif; ?>




                                    </td>
                                </tr>
                        <?php endforeach;
                        } else {
                            echo 'No Data Available';
                        }
                        ?>
                    </tbody>

        </table>
    </div>
</div>
</div>

<script>
    
    function confirmSubmit(form, complain_id) {
        Swal.fire({
            title: 'Delete!',
            text: 'Hey <?php echo $peracc[0]["firstname"]; ?>, are you sure you want to delete your complaint?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.action = 'delete_complaint.php';
                
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'complain_id';
                hiddenInput.value = complain_id;
                
                form.appendChild(hiddenInput);

                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Complaint deleted successfully.',
                            onClose: () => {
                                window.location.href = 'complain.php';
                            }
                        });
                    } else {
                      
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while processing your request.'
                    });
                });
            }
        });
    }
</script>




<?php
include 'src/db.php';

if(isset($_POST['dltcomplaintbtn'])){
    $complaint_id = $_POST["complain_id"];
    $employee_id = $_POST["employee_id"];

    $sql = "DELETE FROM complaint_tbl WHERE complain_id = '$complaint_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        echo '<script> swal.fire({
            icon: "success",
            title: "Your Complaint Has been deleted Deleted ",
            text: "Deleted"
        });
        </script>';
        header("refresh:1;");
    }else{
        echo 'error';
    }
}

?>




<?php
include 'src/init.php';

if (isset($_POST['editcomplainbtn'])) {
    $complainID = $strip->strip($_POST['complain_id']);
    $complainlm = $strip->strip($_POST['landmark']);
    $complain_desc = $strip->strip($_POST['complaint_desc']);
    
    $sql = "UPDATE complaint_tbl SET landmark = '$complainlm', complaint_desc = '$complain_desc' WHERE complain_id = '$complainID'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo '<script> 
                swal.fire({
                    icon: "success",
                    title: "Change has been Saved!",
                    text: "Click OK to refresh the page.",
                    type: "success"
                }).then(function(){
                    window.location="complain.php";
                });
              </script>';
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>


</div>
<script>
        new DataTable('#example', {
    responsive: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    }
    
});


    </script>

 

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
    <span>Copyright &copy; Your Website 2020</span>
</div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>


<!-- Bootstrap core JavaScript-->
   
</body>

</html>