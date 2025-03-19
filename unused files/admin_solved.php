
<?php include "sidebar.php"?>
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



function get_allsolved_complain() {
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
WHERE complaint_tbl.complaint_status = 2";

            
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
$consumercomplain = get_allsolved_complain();          
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
                        <td class="text-break"><?= $complain['landmark']; ?> , <?= $complain['meter_srn']; ?> , <?= $complain['pole_id']; ?></td>
                        <td class="text-break"><?= $complain['complaint_desc']; ?></td>
                        <td><?= $complain['solver_first_name']; ?> <?= $complain['solver_last_name']; ?></td>
                        <td><?= $complain['approved_officer_first_name']; ?> <?= $complain['approved_officer_last_name']; ?></td>
                        <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
</td>

                      


    
    
    
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