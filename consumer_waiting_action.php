
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

function get_waiting_complain($employee_id) {
    global $con;
    $list = array();

    $sql = "SELECT
        consumer_tbl.consumer_id,
        consumer_tbl.firstname,
        consumer_tbl.account_num,
        consumer_tbl.city,
        consumer_tbl.barangay,
        consumer_tbl.lastname,
        complaint_tbl.landmark,
        complaint_tbl.complaint_desc,
        complaint_tbl.complaint_status,
        notification_tbl.stat_code,
        notification_tbl.employee_id AS receiver_employee_id,
        CONCAT(emp_tbl.first_name, ' ', emp_tbl.last_name) AS receiver_name,
        action_tbl.action_details,
        action_tbl.start_date_time,
        action_tbl.end_date_time,
        action_tbl.employee_id AS sender_employee_id,
        CONCAT(emp2_tbl.first_name, ' ', emp2_tbl.last_name) AS sender_name
    FROM
        consumer_tbl
    INNER JOIN
        complaint_tbl ON consumer_tbl.consumer_id = complaint_tbl.consumer_id
    LEFT JOIN
        notification_tbl ON complaint_tbl.complain_id = notification_tbl.complain_id
    LEFT JOIN
        emp_tbl ON notification_tbl.employee_id = emp_tbl.employee_id
    LEFT JOIN
        action_tbl ON complaint_tbl.complain_id = action_tbl.complain_id
    LEFT JOIN
        emp_tbl AS emp2_tbl ON action_tbl.employee_id = emp2_tbl.employee_id
        WHERE action_tbl.employee_id = '$employee_id'";

    $qry = $con->query($sql);

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $list[] = $row;
        }
        return $list;
    } else {
       
        return null;
    }
}
?>




<?php            
$consumercomplain = get_waiting_complain($employee_id);          
?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ConsumerID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Cp No</th>
                    <th>Landmark</th>
                    <th>Metersn</th>
                    <th>Pole</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Reciever</th>
                    <th>Approved By</th>
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
                    <th>Reciever</th>
                    <th>Approved By</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($consumercomplain as $complain): ?>
                    <tr>
                        <td><?= $complain['consumer_id']; ?></td>
                        <td><?= $complain['firstname']; ?> <?= $complain['lastname']; ?></td>
                        <td><?= $complain['account_num']; ?></td>
                        <td><?= $complain['city']; ?>, <?= $complain['barangay']; ?></td>
                        <td><?= $complain['cpnum']; ?></td>
                        <td><?= $complain['landmark']; ?></td>
                        <td><?= $complain['meter_srn']; ?></td>
                        <td><?= $complain['pole_id']; ?></td>
                        <td><?= $complain['complaint_desc']; ?></td>
                        <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
</td>
<td><?= $complain['receiver_name']; ?></td>
<td><?= $complain['sender_name']; ?></td>
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
                <label>Location: </label> <?= $complain['city']; ?>, <?= $complain['barangay']; ?><br>
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

    $sql = "SELECT emp_tbl.*, user_tbl.role
            FROM emp_tbl
            INNER JOIN user_tbl ON emp_tbl.employee_id = user_tbl.employee_id
            WHERE user_tbl.role > 2 AND user_tbl.role != 4";

    $qry = $con->query($sql);
    

    
    
    while ($employee = mysqli_fetch_assoc($qry)) { ?>
    <?php
    $spanrole = "Employee";
    if($employee['role'] == 3){
       $spanrole = "CITET";
    } 

     if($employee['role'] == 4){
         $spanrole = "AUDIT";
    } 

    if($employee['role'] == 5){
      $spanrole = "BILLING";
 } 
 ?>
        <option value="<?= $employee['employee_id'] ?>"><?= $employee['first_name'] ?> <?= $employee['last_name'] ?> <?php echo $spanrole; ?></option>
    <?php } ?>
</select>

                
                    <div class="invalid-feedback">Please, select a Employee!</div>
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