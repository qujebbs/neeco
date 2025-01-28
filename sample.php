
<?php
include "sidebar.php";




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>neecollarea1.com</title>
  
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
    
</head>

<?php
              $town_code = $peracc[0]['city'];
              if($town_code == 'SANTO DOMINGO' ){
                 $town_code = "SD";
              } 
              if($town_code == 'TALAVERA' ){
                 $town_code = "TAL";
              } 
              if($town_code == 'ALIAGA' ){
                $town_code = "ALG";
             } 
             if($town_code == 'TALUGTUG' ){
                $town_code = "TALG";
             } 
             if($town_code == 'GUIMBA' ){
                $town_code = "GMB";
             } 
             if($town_code == 'CARRANGLAN' ){
                $town_code = "CRN";
             } 
             if($town_code == 'LICAB' ){
                $town_code = "LIC";
             } 
             if($town_code == 'SCIENCE CITY OF MUÑOZ' ){
                $town_code = "MNZ";
             } 
             if($town_code == 'LUPAO' ){
                $town_code = "LUP";
             } 
             if($town_code == 'QUEZON' ){
                $town_code = "QZN";
             } 
              

              ?>

<div class="container-fluid">

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->

<?php
session_start();
include 'src/init.php';



function get_all_complain() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM complaint_tbl
            JOIN consumer_tbl ON complaint_tbl.consumer_id = consumer_tbl.consumer_id
            JOIN town_tbl ON complaint_tbl.town_id = town_tbl.town_id 
            JOIN emp_tbl ON complaint_tbl.employee_id = emp_tbl.employee_id";
            
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
$consumercomplain = get_all_complain();          
?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Complaint ID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Cp No</th>
                    <th>Landmark</th>
                    <th>Metersn</th>
                    <th>Pole</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Complaint ID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Cp No</th>
                    <th>Landmark</th>
                    <th>Metersn</th>
                    <th>Pole</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($consumercomplain as $complain): ?>
                    <tr>
                        <td><?= $complain['complain_id']; ?></td>
                        <td><?= $complain['firstname']; ?> <?= $complain['lastname']; ?></td>
                        <td><?= $complain['account_num']; ?></td>
                        <td><?= $complain['town_name']; ?>, <?= $complain['barangay']; ?></td>
                        <td><?= $complain['cpnum']; ?></td>
                        <td><?= $complain['landmark']; ?></td>
                        <td><?= $complain['meter_srn']; ?></td>
                        <td><?= $complain['pole_id']; ?></td>
                        <td><?= $complain['complaint_desc']; ?></td>
                        <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
</td>

                        <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal<?= $complain['complain_id']; ?>">
    <i class="fas fa-check"></i>
</button>

<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#viewModal<?= $complain['complain_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="addModal<?= $complain['complain_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $complain['complain_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModal<?= $complain['complain_id']; ?>">Forward</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <label>Account Number: </label> <?= $complain['account_num']; ?><br>
                <label>Full Name: </label> <?= $complain['firstname']; ?> <?= $complain['lastname']; ?><br>
                <label>Location: </label> <?= $complain['town_name']; ?>, <?= $complain['barangay']; ?><br>
                <label>Landmark: </label> <?= $complain['landmark']; ?> <br> <?= $complain['meter_srn']; ?>, <br> <?= $complain['pole_id']; ?><br>
<form action="#" method="POST" enctype="multipart/form-data">
               
                <input type="hidden" name="complain_id" id="complain_id" value="<?= $complain['complain_id']; ?>">
                
              
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Forward To</label>
                    <select class="form-select" name="employee_id" required>
    <option selected disabled>Select an employee...</option>
    <?php
    include 'src/init.php';
    global $con;
    
    $town = $peracc[0]['town_id'];

    $sql = "SELECT *
            FROM user_tbl
            JOIN emp_tbl ON user_tbl.employee_id = emp_tbl.employee_id
            JOIN position_tbl ON emp_tbl.pos_id = position_tbl.pos_id
            JOIN town_tbl ON emp_tbl.town_id = town_tbl.town_id
            WHERE user_tbl.role != 7 AND emp_tbl.town_id = '$town'";

    $qry = $con->query($sql);
    

    
    
    while ($employee = mysqli_fetch_assoc($qry)) { ?>
     <?php
    $spanrole = "Consumer";
    if($employee['role'] == 2){
       $spanrole = "ADMIN";
    } 

     if($employee['role'] == 3){
         $spanrole = "Finance";
    } 

    if($employee['role'] == 4){
      $spanrole = "TSD";
 } 
 if($employee['role'] == 5){
    $spanrole = "HR";
} 
if($employee['role'] == 6){
    $spanrole = "OGM";
} 
if($employee['role'] == 7){
    $spanrole = "DCSO";
} 
if($employee['role'] == 8){
    $spanrole = "Lineman";
} 
if($employee['role'] == 9){
    $spanrole = "Citet";
} 
if($employee['role'] == 10){
    $spanrole = "Audit";
} 
 ?>
        <option value="<?= $employee['employee_id'] ?>"><?= $employee['first_name'] ?> <?= $employee['last_name'] ?> (<?php echo $spanrole; ?>) </option>
    <?php } ?>
</select>

                
                    <div class="invalid-feedback">Select an Employee</div>
                </div>
            
    <input type="submit" name="submit">

   
</form>
                </div>
            </div>
        </div>
    </div> 
    
    
    
                </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php 
    include 'src/db.php';

    if(isset($_POST['submit'])){
        $complain_id = $_POST['complain_id'];
        $employee_id = $_POST['employee_id'];
       
      
        $sql = "INSERT INTO notification_tbl (complain_id, employee_id) VALUES ('$complain_id', '$employee_id')";
        $result = mysqli_query($con, $sql);
                
        if($result){
            $sql = "UPDATE complaint_tbl SET complaint_status = 1 WHERE complain_id = '$complain_id'";
            $result = mysqli_query($con, $sql);
            if($result){
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Notification has been sent!"
                });
                </script>';
                header("refresh:1;");
            }
        } else {
            echo "error";
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
<!-- Bootstrap JS (Order matters: jQuery, Popper.js, Bootstrap) -->

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

<!-- Bootstrap core JavaScript-->
    

</body>

</html>