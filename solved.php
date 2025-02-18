
<?php
include "sidebar.php";




?>
<!DOCTYPE html>
<html lang="en">

<?php include "views/fragments/metadata.php"; ?>

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
    complaint_tbl.*,
    consumer_tbl.firstname,
    consumer_tbl.account_num,
    consumer_tbl.lastname,
    consumer_tbl.barangay,
    consumer_tbl.cpnum,
    town_table.town_description,
    emp_approved.first_name AS approved_officer_first_name,
    emp_approved.last_name AS approved_officer_last_name,
    action_tbl.employee_id AS solver_id,
    emp_solver.first_name AS solver_first_name,
    emp_solver.last_name AS solver_last_name
FROM complaint_tbl
JOIN consumer_tbl ON complaint_tbl.consumer_id = consumer_tbl.consumer_id
JOIN town_table ON complaint_tbl.town_code = town_table.town_code 
JOIN emp_tbl AS emp_approved ON complaint_tbl.employee_id = emp_approved.employee_id
LEFT JOIN action_tbl ON complaint_tbl.complain_id = action_tbl.complain_id
LEFT JOIN emp_tbl AS emp_solver ON action_tbl.employee_id = emp_solver.employee_id
WHERE complaint_tbl.complaint_status = 2 AND complaint_tbl.employee_id = '$employee_id'";

            
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
                    <th>Landmark Details</th>
                    <th>Complaint Details</th>
                    <th>Solver Name</th>
                    <th>Approved By</th>
                    <th>Status</th>
                   
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Complaint ID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Cp No</th>
                    <th>Landmark Details</th>
                    <th>Complaint Details</th>
                    <th>Solver Name</th>
                    <th>Approved By</th>
                    <th>Status</th>
                    
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($consumercomplain as $complain): ?>
                    <tr>
                        <td><?= $complain['consumer_id']; ?></td>
                        <td><?= $complain['firstname']; ?> <?= $complain['lastname']; ?></td>
                        <td><?= $complain['account_num']; ?></td>
                        <td><?= $complain['town_description']; ?>, <?= $complain['barangay']; ?></td>
                        <td><?= $complain['cpnum']; ?></td>
                        <td><?= $complain['landmark']; ?> , <?= $complain['meter_srn']; ?> , <?= $complain['pole_id']; ?></td>
                        <td><?= $complain['complaint_desc']; ?></td>
                        <td><?= $complain['solver_first_name']; ?> <?= $complain['solver_last_name']; ?></td>
                        <td><?= $complain['approved_officer_first_name']; ?> <?= $complain['approved_officer_last_name']; ?></td>
                        <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
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
<?php include 'views/fragments/tableFooter.php'; ?>

</body>

</html>