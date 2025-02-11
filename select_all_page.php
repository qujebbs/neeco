
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

<?php
session_start();
include 'src/init.php';



function get_pending_complain($employee_id) {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM complaint_tbl
            JOIN consumer_tbl ON complaint_tbl.consumer_id = consumer_tbl.consumer_id
            JOIN town_table ON complaint_tbl.town_code = town_table.town_code 
            JOIN emp_tbl ON complaint_tbl.employee_id = emp_tbl.employee_id
            WHERE complaint_tbl.employee_id = '$employee_id' AND complaint_tbl.complaint_status = 0";
            
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





<?php            
$consumercomplain = get_pending_complain($employee_id);          
?> 
 
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   
<a href="pending.php" type="submit" class="btn btn-dark">Cancel</a>      
                    </div>

 
<div class="card-body">
<form action="" method="POST">
    <div class="table-responsive">
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            
            <thead>
                <tr>
          
                <th>
                    <button type="submit" name="select_all_button" class="btn btn-primary">FORWARD ID</button> 
                </th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Cp No</th>
                    <th>Landmark</th>
                    <th>Metersn</th>
                    <th>Pole</th>
                    <th>Details</th>
                   
                   
                </tr>
            </thead>
            <tfoot>
                <tr>
                    
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($consumercomplain as $complain): ?>
                    <tr>
                    <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="checkbox[]" value="<?= $complain['complain_id']; ?>">
                    <label for="checkbox1"><?= $complain['complain_id']; ?></label>
                </span>
            </td>
            
                        <td><?= $complain['firstname']; ?> <?= $complain['lastname']; ?></td>
                        <td><?= $complain['street']; ?>, <?= $complain['town_name']; ?>, <?= $complain['barangay']; ?></td>
                        <td><?= $complain['cpnum']; ?></td>
                        <td><?= $complain['landmark']; ?></td>
                        <td><?= $complain['meter_srn']; ?></td>
                        <td><?= $complain['pole_id']; ?></td>
                        <td><?= $complain['complaint_desc']; ?></td>
                        <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
</td>


    
    
    
             
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php $allreason =$qrys->selectall('nature_complaint_tbl'); 


?> 

<div class="mb-3">

<label for="nature_id" class="form-label">Nature/ Reason Of Complaints</label>
<select class="form-select" name="nature_id" aria-label="Default select example" required="required">

<option selected disabled>Nature Of Complaints</option>
<?php for($allc=0;$allc<count($allreason);$allc++){ ?>
<option value="<?php echo $allreason[$allc]['nature_id']?>"><?php echo $allreason[$allc]['complaint_reason']?></option>

<?php } ?>
</select>
</div>

        <div class="mb-3">
                    <label for="employee_id" class="form-label">Forward To</label>
                    <select class="form-select" name="employee_id" required>
    <option selected disabled>Select an employee...</option>
    <?php
    include 'src/init.php';
    global $con;
    
    $town = $peracc[0]['town_code'];

    $sql = "SELECT *
            FROM user_tbl
            JOIN emp_tbl ON user_tbl.employee_id = emp_tbl.employee_id
            JOIN position_tbl ON emp_tbl.pos_id = position_tbl.pos_id
            JOIN town_table ON emp_tbl.town_code = town_table.town_code
            WHERE user_tbl.pos_id NOT IN (7, 2) AND emp_tbl.town_code = '$town'";

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
                </form>
       

    </div>
</div>
</div>

<?php 
include 'src/db.php';

if(isset($_POST['select_all_button'])){
    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        $selected_ids = $_POST['checkbox']; 
        $nature_id = $_POST['nature_id'];
        
        
        if(isset($_POST['employee_id']) && $_POST['employee_id'] !== '') {
            $employee_id = $_POST['employee_id'];

            foreach($selected_ids as $complain_id) {
                $sql = "INSERT INTO notification_tbl (complain_id, employee_id) VALUES ('$complain_id', '$employee_id')";
                $result = mysqli_query($con, $sql);

                $sql_update = "UPDATE complaint_tbl SET complaint_status = 1, nature_id = $nature_id WHERE complain_id = $complain_id";
                $result_update = mysqli_query($con, $sql_update);

                if($result && $result_update) {
                    echo '<script> swal.fire({
                        icon: "success",
                        title: "Change has been Saved!",
                        text: "Click ok to refresh the page.",
                        type: "success"
                    }).then(function(){
                        window.location="pending.php";
                    });
                    </script>';
                } else {
                    echo '<script> swal.fire({
                        icon: "error",
                        title: "Error occurred while processing the request!"
                    });
                    </script>';
                }
            }
        } else {
            
            echo '<script> swal.fire({
                icon: "warning",
                title: "Warning",
                text: "You Did Not Select An Employee! Please select an employee to prevent this error message"
            });
            </script>';
        }
    } else {
        echo "No complaints selected!";
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