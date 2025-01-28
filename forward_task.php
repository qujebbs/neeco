
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


<!-- DataTales Example -->

<!-- DataTales Example -->






                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>ConsumerID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Complaint Details</th>
                    <th>Landmark</th>
                    <th>Pole & Serial Number</th>
                    <th>Assigned To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>ConsumerID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Complaint Details</th>
                    <th>Landmark</th>
                    <th>Pole & Serial Number</th>
                    <th>Assigned To</th>
                    <th>Action</th>
                    
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        

                        $historycomplain = get_complain_notification($employee_id);

                        if ($historycomplain) {
                            foreach ($historycomplain as $bill) : ?>
                                <tr>
                                    
                                <td><?= $bill['consumer_id']; ?></td>
                        <td><?= $bill['firstname']; ?> <?= $bill['lastname']; ?></td>
                        <td><?= $bill['account_num']; ?></td>
                        <td><?= $bill['town_code']; ?>, <?= $bill['town_description']; ?></td>
                        <td><?= $bill['complaint_desc']; ?></td>
                        <td><?= $bill['landmark']; ?></td>
                        <td><?= $bill['pole_id']; ?>, <?= $bill['meter_srn']; ?></td>
                        <td><?= $bill['first_name']; ?> <?= $bill['last_name']; ?></td>
                        

                        <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewModal<?= $bill['complain_id']; ?>">
    <i class="fas fa-check"></i>
</button>       

<div class="modal fade" id="viewModal<?= $bill['complain_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModal<?= $bill['complain_id']; ?>" aria-hidden="true">
     <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Action Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                    
                    <form action="" method="POST">
                    
                    <input type="hidden" id="complain_id" name="complain_id" value="<?= $bill['complain_id']; ?>">
                    <div class="form-group">
                            <label for="action_details">Action Taken:</label>
                            <input type="text" class="form-control" id="action_details" name="action_details" required>
                        </div>

                        <?php $allreason =$qrys->selectall('nature_complaint_tbl'); 


                    ?> 

<div class="mb-3">

<label for="nature_id" class="form-label">Forward To</label>
<select class="form-select" name="nature_id" aria-label="Default select example" required="required">
 
 <option selected disabled>Nature Of Complaints</option>
<?php for($allc=0;$allc<count($allreason);$allc++){ ?>
<option value="<?php echo $allreason[$allc]['nature_id']?>"><?php echo $allreason[$allc]['complaint_reason']?></option>

<?php } ?>
</select>
</div>

                        <div class="form-group">
                            <label for="start_date/time">Date Attended:</label>
                            <input type="datetime-local" class="form-control" id="start_date/time" name="start_date/time">
                        </div>

                        <div class="form-group">
                            <label for="employee_id"></label>
                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" value=<?php echo $peracc[0]['employee_id']; ?>>
                        </div>

                       

                <div>
         <input type="checkbox" id="check" name="check" />
         <label for="check">Check This if the Complaint Has been Solved</label>
            </div>
                    <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    <a href="forward_task.php" class="btn btn-danger">Back</a>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#forwardModal<?= $bill['complain_id']; ?>" style="text-align: center;">
    <i class="">...</i>
    </button>

    <div class="modal fade" id="forwardModal<?= $bill['complain_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="forwardModal<?= $bill['complain_id']; ?>" aria-hidden="true">
     <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Forward Another Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                    
                    <form action="" method="POST">
                    
                    
                    <input type="hidden" id="complain_id" name="complain_id" value="<?= $bill['complain_id']; ?>">

                    <div class="mb-3">
                    <label for="employee_id" class="form-label">Forward To</label>
                    <select class="form-select" name="employee_id" required>
    <option selected disabled>Select an employee...</option>
    <?php
    include 'src/init.php';
    global $con;
    
    $town = $peracc[0]['town_code'];
    $emp_id = $peracc[0]['employee_id'];

    $sql = "SELECT *
            FROM user_tbl
            JOIN emp_tbl ON user_tbl.employee_id = emp_tbl.employee_id
            JOIN position_tbl ON emp_tbl.pos_id = position_tbl.pos_id
            JOIN town_table ON emp_tbl.town_code = town_table.town_code
            WHERE user_tbl.pos_id NOT IN (7, 2) AND emp_tbl.town_code = '$town' AND emp_tbl.employee_id != '$emp_id'";

    $qry = $con->query($sql);
    
    while ($employee = mysqli_fetch_assoc($qry)) {
        $pos_id = $employee['pos_id'];
        $sql_position = "SELECT position_name FROM position_tbl WHERE pos_id = '$pos_id'";
        $qry_position = $con->query($sql_position);
        $position = mysqli_fetch_assoc($qry_position)['position_name'];
?>
        <option value="<?= $employee['employee_id'] ?>"><?= $employee['first_name'] ?> <?= $employee['last_name'] ?> (<?= $position ?>) </option>
<?php 
    } 
?>

      
</select>

                
                    <div class="invalid-feedback">Select an Employee</div>
                </div>

                       

                
                    <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="forward" value="Submit">
                    <a href="forward_task.php" class="btn btn-danger">Back</a>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
            </td>


            
                                </tr>
                        <?php endforeach;
                        } else {
                            echo 'No data available';
                        }
                        ?>
                    </tbody>

        </table>
    </div>
</div>
</div>

<?php 
    include 'src/db.php';

    if(isset($_POST['submit'])){
        $complain_id = $_POST['complain_id'];
        $action_details = $_POST['action_details'];
        $start_date = $_POST['start_date/time'];
        $employee_id = $_POST['employee_id'];
        $nature_id = $_POST['nature_id'];

        $sql = "INSERT INTO action_tbl (complain_id, action_details, start_date_time, employee_id) VALUES ('$complain_id', '$action_details', '$start_date', '$employee_id')";
        $result = mysqli_query($con, $sql);

        if($result){
            
            $updateNotificationSql = "UPDATE notification_tbl SET stat_code = 1 WHERE complain_id = '$complain_id'";
            $updateNotificationResult = mysqli_query($con, $updateNotificationSql);

           
            $updateComplaintSql = "UPDATE complaint_tbl SET complaint_status = 2, nature_id = '$nature_id' WHERE complain_id = '$complain_id'";
            $updateComplaintResult = mysqli_query($con, $updateComplaintSql);

            if($updateNotificationResult && $updateComplaintResult){
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Issue Resolved!"
                });
                </script>';
                header("refresh:1;");
            } else {
                echo "error updating notification_tbl or complaint_tbl";
            }
        } else {
            echo "error inserting into action_tbl";
        }
    }  
?>


<?php 
    include 'src/db.php';

    if(isset($_POST['forward'])){
        $employee_id = $_POST['employee_id'];
        $complain_id = $_POST['complain_id'];
       

        $sql = "UPDATE notification_tbl SET employee_id = '$employee_id' WHERE complain_id = '$complain_id'";
        $result = mysqli_query($con, $sql);

        if($result){
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Complaint Has been sent into another employee!"
                });
                </script>';
                header("refresh:1;");
        } 
    }  
?>

</div>


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
<script>
        new DataTable('#example', {
    responsive: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    }
    
});


    </script>

<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
  <!--  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> error in logout dropdown-->

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>