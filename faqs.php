<?php
include "sidebar.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Webpage</title>
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>

<div class="container-fluid">

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Add Company Awards</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">FAQs </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                                                   
                    <div class="form-group">
    <label for="award_type">Award Type:</label>
    <select class="form-control" id="award_type" name="award_type" required>
        <option value="">Select Award Type</option>
        <option value="Award">Award</option>
        <option value="Special Citation">Special Citation</option>
        <option value="Certificate Of Commendation">Certificate Of Commendation</option>
        <option value="Plaque of Recognition">Plaque of Recognition</option>
        <option value="Certificate Of Recognition for RQIM Network">Certificate Of Recognition for RQIM Network</option>
       
    </select>
</div>


                    <div class="form-group">
                        <label for="award_name">Award Name:</label>
                        <input type="text" class="form-control" id="award_name" name="award_name" required>
                    </div>

                    <div class="form-group">
                        <label for="award_from">Award From:</label>
                        <input type="text" class="form-control" id="award_from" name="award_from" required>
                    </div>

                    <div class="form-group">
                        <label for="award_date">Award Date:</label>
                        <input type="date" class="form-control" id="award_date" name="award_date" required>
                    </div>



<button type="submit" name="addawardbtn" class="btn btn-primary">Submit</button>
<?php
include 'src/init.php';

if (isset($_POST['addawardbtn'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $award_name = $strip->strip($_POST['award_name']);
    $award_type = $strip->strip($_POST['award_type']);
    $award_from = $strip->strip($_POST['award_from']);
    $award_date = $strip->strip($_POST['award_date']);

    
    $newsInsert = $qrys->insert('awards', array(
        'award_type' => $award_type,
        'award_name' => $award_name,
        'award_from' => $award_from,
        'award_date' => $award_date
       
    ));

    
    if ($newsInsert) {
        $logsQuery = $qrys->insert('logs_tbl', array(
            'employee_id' => $employee_id,
            'log_activity' => 'Add New Awards'
        ));

        if ($logsQuery) {
            echo '<script> 
            swal.fire({
                icon: "success",
                title: "Success",
                text: "Successfully Added New Awards"
            }).then(function() {
                window.location.href = "awards.php"; 
            });
        </script>
        ';
        } else {
           
            echo "Error inserting log activity: " . $qrys->error();
        }
    } else {
       
        echo "Error inserting data into database: " . $qrys->error();
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
include 'src/init.php';

function get_alls_awards() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM awards";
            
    $qry = $con->query($sql);

    $rowcount = mysqli_num_rows($qry);

    if ($rowcount != 0) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
        return $list;
    }
    return null;
}

$allawards = get_alls_awards();
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>Award Name</th>
                <th>Award Type</th>
                <th>Award From</th>
                <th>Award Date</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Award Name</th>
                <th>Award Type</th>
                <th>Award From</th>
                <th>Award Date</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $allawards = get_alls_awards();

                        if ($allawards) {
                            foreach ($allawards as $awards) : ?>
                                <tr>
                                    
                                <td><?= $awards['award_name']; ?></td>
                                <td><?= $awards['award_type']; ?></td>
                                <td><?= $awards['award_from']; ?></td>
                               <td> <?= date("F j, Y", strtotime($awards['award_date'])); ?> </td>

        
                               
                               

                        <td>
   
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $awards['award_id']; ?>">
    <i class="fas fa-edit"></i>
</button>


                        <div class="modal fade" id="editModal<?= $awards['award_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabeleditModal<?= $awards['award_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal<?= $awards['award_id']; ?>">Edit Company Awards </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" name="award_id" value="<?= $awards['award_id']; ?>">    
                    <div class="form-group">
    <label for="award_type">Award Type:</label>
    <select class="form-control" id="award_type" name="award_type" required>
        <option value="">Select Award Type</option>
        <option value="Award">Award</option>
        <option value="Special Citation">Special Citation</option>
        <option value="Certificate Of Commendation">Certificate Of Commendation</option>
        <option value="Plaque of Recognition">Plaque of Recognition</option>
        <option value="Certificate Of Recognition for RQIM Network">Certificate Of Recognition for RQIM Network</option>
       
    </select>
</div>


                    <div class="form-group">
                        <label for="award_name">Award Name:</label>
                        <input type="text" class="form-control" id="award_name" name="award_name" required>
                    </div>

                    <div class="form-group">
                        <label for="award_from">Award From:</label>
                        <input type="text" class="form-control" id="award_from" name="award_from" required>
                    </div>

                    <div class="form-group">
                        <label for="award_date">Award Date:</label>
                        <input type="date" class="form-control" id="award_date" name="award_date" required>
                    </div>


<div class="modal-footer">
<button type="submit" name="editawardsbtn" class="btn btn-primary">Submit</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $awards['award_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $awards['award_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $rates['rate_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $awards['award_id']; ?>"> Delete Awards</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this Awards? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                    <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">
                    <input type="hidden" class="form-control" id="award_id" name="award_id" value="<?= $awards['award_id']; ?>">

                  


<div class="modal-footer">
<button type="submit" name="dltpdfbtn" class="btn btn-primary">Submit</button>
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
include 'src/db.php';

if(isset($_POST['dltpdfbtn'])){
    $award_id = $_POST["award_id"];
    $employeeid = $_POST["employee_id"];
    
    $sql = "DELETE FROM awards WHERE award_id = '$award_id'";
    $result = mysqli_query($con, $sql);

    if($result){
      $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Delete Awards')";
      $logResult = mysqli_query($con, $logSql);
      if ($logResult) {
          
          mysqli_commit($con);
          echo '<script> 
                  swal.fire({
                      icon: "success",
                      title: "Change has been Saved!",
                      text: "PDF DELETED.",
                      type: "success"
                  }).then(function(){
                      window.location="awards.php";
                  });
              </script>';
      }
    }else{
        echo 'error';
    }
}

?>

<?php
include 'src/init.php';

if (isset($_POST['editawardsbtn'])) {
   $award_id = $_POST["award_id"];
   $employeeID = $_POST['employee_id'];
   $awardType = $_POST['award_type'];
   $awardName = $_POST['award_name'];
   $awardFrom = $_POST['award_from'];
   $awardDate = $_POST['award_date'];

   
   $sql = "UPDATE awards SET award_type = '$awardType', award_name = '$awardName', award_from = '$awardFrom', award_date = '$awardDate' WHERE award_id = $award_id";
   $result = mysqli_query($con, $sql);

   if($result){
      $logsQuery = "INSERT INTO logs_tbl (employee_id, activity_log) VALUES ('$employeeID', 'Edit Awards')";
      $logsresult = mysqli_query($con, $logsQuery);

      if($logsresult){
         echo '<script> swal.fire({
            icon: "success",
            title: "Edit Success"
        });
        </script>';
        header("refresh:1;");
      }
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