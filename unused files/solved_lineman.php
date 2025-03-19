
<?php
include "sidebar.php";




?>


<?php

function get_solved_peremp($employee_id) {
    global $con;
    $list = array();

    $stmt = $con->prepare("SELECT 
        consumer_tbl.consumer_id, 
        consumer_tbl.firstname, 
        consumer_tbl.profilepix, 
        consumer_tbl.lastname, 
        consumer_tbl.account_num, 
        consumer_tbl.barangay, 
        complaint_tbl.landmark, 
        consumer_tbl.meter_srn, 
        consumer_tbl.pole_id, 
        complaint_tbl.complaint_desc, 
        complaint_tbl.complaint_status, 
        notification_tbl.stat_code, 
        notification_tbl.employee_id, 
        notification_tbl.complain_id, 
        emp_tbl.first_name, 
        emp_tbl.last_name,
        town_table.town_description
    FROM 
        consumer_tbl
    INNER JOIN 
        complaint_tbl ON consumer_tbl.consumer_id = complaint_tbl.consumer_id
    INNER JOIN 
        notification_tbl ON complaint_tbl.complain_id = notification_tbl.complain_id
    INNER JOIN 
        emp_tbl ON notification_tbl.employee_id = emp_tbl.employee_id
    INNER JOIN 
        town_table ON complaint_tbl.town_code = town_table.town_code    
    WHERE 
        notification_tbl.employee_id = ? AND complaint_tbl.complaint_status = 2 ORDER BY complaint_tbl.complain_id DESC");

    $stmt->bind_param("s", $employee_id);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }

    $stmt->close();

    if (!empty($list)) {
        return $list;
    }

    return null;
}
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
                    <th>Status</th>
                   
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
                    <th>Status</th>
                   
                    
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        

                        $historycomplain = get_solved_peremp($employee_id);

                        if ($historycomplain) {
                            foreach ($historycomplain as $bill) : ?>
                                <tr>
                                    
                                <td><?= $bill['consumer_id']; ?></td>
                        <td><?= $bill['firstname']; ?> <?= $bill['lastname']; ?></td>
                        <td><?= $bill['account_num']; ?></td>
                        <td><?= $bill['town_name']; ?>, <?= $bill['barangay']; ?></td>
                        <td><?= $bill['complaint_desc']; ?></td>
                        <td><?= $bill['landmark']; ?></td>
                        <td><?= $bill['pole_id']; ?>, <?= $bill['meter_srn']; ?></td>
                        <td><?= $bill['first_name']; ?> <?= $bill['last_name']; ?></td>
                        <td style="color: <?= $bill['complaint_status'] == 0 ? 'red' : ($bill['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $bill['complaint_status'] == 0 ? 'Pending...' : ($bill['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
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

    if(isset($_POST['submit'])){
        $complain_id = $_POST['complain_id'];
        $action_details = $_POST['action_details'];
        $start_date = $_POST['start_date/time'];
        $employee_id = $_POST['employee_id'];

        $sql = "INSERT INTO action_tbl (complain_id, action_details, start_date_time, employee_id) VALUES ('$complain_id', '$action_details', '$start_date', '$employee_id')";
        $result = mysqli_query($con, $sql);

        if($result){
            
            $updateNotificationSql = "UPDATE notification_tbl SET stat_code = 1 WHERE complain_id = '$complain_id'";
            $updateNotificationResult = mysqli_query($con, $updateNotificationSql);

           
            $updateComplaintSql = "UPDATE complaint_tbl SET complaint_status = 2 WHERE complain_id = '$complain_id'";
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
<script>
        new DataTable('#example', {
    responsive: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    }
    
});


    </script>
<!-- Footer -->
<?php include 'views/fragments/tableFooter.php'; ?>

</body>

</html>