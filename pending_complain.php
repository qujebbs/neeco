
<?php
include "sidebar.php";




?>
<!DOCTYPE html>
<html lang="en">

<?php include "views/fragments/metadata.php"; ?>

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



function get_user_complain() {
    global $con;
    $list = array();

    $sql = "SELECT consumer_tbl.consumer_id, complaint_tbl.complain_id, consumer_tbl.account_num, consumer_tbl.firstname, consumer_tbl.lastname, consumer_tbl.city, consumer_tbl.email, consumer_tbl.cpnum, consumer_tbl.barangay, complaint_tbl.complaint_desc, complaint_tbl.meter_srn, complaint_tbl.complaint_status, complaint_tbl.pole_id, complaint_tbl.landmark
            FROM consumer_tbl
            INNER JOIN complaint_tbl ON consumer_tbl.consumer_id = complaint_tbl.consumer_id
            WHERE complaint_tbl.complaint_status = 0";
            
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
$consumercomplain = get_user_complain();          
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
                        <td><?= $complain['consumer_id']; ?></td>
                        <td><?= $complain['firstname']; ?> <?= $complain['lastname']; ?></td>
                        <td><?= $complain['account_num']; ?></td>
                        <td><?= $complain['city']; ?>, <?= $complain['barangay']; ?></td>
                        <td><?= $complain['cpnum']; ?></td>
                        <td><?= $complain['landmark']; ?></td>
                        <td><?= $complain['meter_srn']; ?></td>
                        <td><?= $complain['pole_id']; ?></td>
                        <td><?= $complain['complaint_desc']; ?></td>
                        <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : 'green'; ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : 'Solved'; ?>
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
            echo '<script> swal.fire({
                icon: "success",
                title: "Notification has been sent!"
            });
            </script>';
            header("refresh:1;");
        } else {
            echo "error";
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