
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



<?php 

function get_your_bill($consumer_id) {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN bill_tbl ON consumer_tbl.consumer_id = bill_tbl.consumer_id
         INNER JOIN town_tbl ON consumer_tbl.town_id = town_tbl.town_id
         WHERE bill_tbl.consumer_id = '$consumer_id' ORDER BY MONTHNAME(bill_tbl.bill_yrmonth)";

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


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>ConsumerID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Kwh Used</th>
                    <th>Current Bill</th>
                    <th>Bill YR/Month</th>
                    <th>DueDate</th>
                    <th>OR Amount</th>
                    <th>OR date</th>
                    <th>Disconnection Date</th>
                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>ConsumerID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Kwh Used</th>
                    <th>Current Bill</th>
                    <th>Bill YR/Month</th>
                    <th>DueDate</th>
                    <th>OR amount</th>
                    <th>OR date</th>
                    <th>Disconnection Date</th>
                    
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        $consumer_id = $_SESSION['consumerid'];  

                        $consumerBills = get_your_bill($consumer_id);

                        if ($consumerBills) {
                            foreach ($consumerBills as $bill) : ?>
                                <tr>
                                    
                                <td><?= $bill['consumer_id']; ?></td>
                        <td><?= $bill['firstname']; ?> <?= $bill['lastname']; ?></td>
                        <td><?= $bill['account_num']; ?></td>
                        <td><?= $bill['town_name']; ?>, <?= $bill['barangay']; ?></td>
                        <td><?= $bill['kwh_used']; ?></td>
                        <td><?= $bill['bill_amount']; ?></td>
                        <td><?= date('F j, Y', strtotime($bill['bill_yrmonth'])); ?></td>
                        <td><?= date('F j, Y', strtotime($bill['due_date'])); ?></td>
                        <td><?= $bill['or_amount']; ?></td>
                        <td><?= date('F j, Y', strtotime($bill['or_date'])); ?></td>
                        <td><?= date('F j, Y', strtotime($bill['disconnection_date'])); ?></td>
                        

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