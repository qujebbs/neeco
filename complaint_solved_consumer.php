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

<?php 

function get_complain_history($consumer_id) {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN complaint_tbl ON consumer_tbl.consumer_id = complaint_tbl.consumer_id
         INNER JOIN town_tbl ON consumer_tbl.town_id = town_tbl.town_id
         WHERE complaint_tbl.consumer_id = '$consumer_id' AND complaint_status = 2";


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
<!-- DataTales Example -->

<!-- DataTales Example -->
<?php
$complainhistory = get_complain_history($consumer_id);
?>






            
          
<label for="complain_details">Name: <?php echo  $peracc[0]['firstname']." ".$peracc[0]['lastname']; ?></label> <br>
    <label for="complain_details">Account No:  <?php echo $peracc[0]['account_num']; ?></label> <br>
    <label for="complain_details">Address:<?php echo $peracc[0]['barangay'] .",".$peracc[0]['street']."". $complainhistory['town_name'];?></label> 
<div class="card-body">
    <div class="table-responsive" style="overflow-x:auto">
        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
        <thead>
                <tr>
                <th>Complain No.</th>
                    <th>Email</th>
                    <th>Landmark</th>
                    <th>Meter Serial No.</th>
                    <th>Pole No.</th>
                    <th>Details</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Complain No.</th>
                    <th>Email</th>
                    <th>Landmark</th>
                    <th>Meter Serial No.</th>
                    <th>Pole No.</th>
                    <th>Details</th>
                    <th>Status</th>
                   
                </tr>
            </tfoot>
            <tbody>
                        <?php
                      

                        $complainhistory = get_complain_history($consumer_id);

                        if ($complainhistory) {
                            foreach ($complainhistory as $complain) : ?>
                                <tr>
                                <td><?= $complain['complain_id']; ?></td>
                                    <td class="text-break" style="font-size: 15px;"><?= $complain['email']; ?></td>
                                    <td><?= $complain['landmark']; ?></td>
                                    <td><?= $complain['meter_srn']; ?></td>
                                    <td><?= $complain['pole_id']; ?></td>
                                    <td><?= $complain['complaint_desc']; ?></td>
                                    <td style="color: <?= $complain['complaint_status'] == 0 ? 'red' : ($complain['complaint_status'] == 1 ? 'orange' : 'green'); ?>">
    <?= $complain['complaint_status'] == 0 ? 'Pending...' : ($complain['complaint_status'] == 1 ? 'Waiting for action...' : 'Solved'); ?>
</td>
                                    
                                  



                                    
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

<script>
    
    function confirmSubmit(form, complain_id) {
        Swal.fire({
            title: 'Delete!',
            text: 'Hey <?php echo $peracc[0]["firstname"]; ?>, are you sure you want to delete your complaint?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.action = 'delete_complaint.php';
                
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'complain_id';
                hiddenInput.value = complain_id;
                
                form.appendChild(hiddenInput);

                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Complaint deleted successfully.',
                            onClose: () => {
                                
                                window.location.href = data.redirect;
                            }
                        });
                    } else {
                      
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while processing your request.'
                    });
                });
            }
        });
    }
</script>




<?php
include 'src/db.php';

if(isset($_POST['dltcomplaintbtn'])){
    $complaint_id = $_POST["complain_id"];
    $employee_id = $_POST["employee_id"];

    $sql = "DELETE FROM complaint_tbl WHERE complain_id = '$complaint_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        echo '<script> swal.fire({
            icon: "success",
            title: "Your Complaint Has been deleted Deleted ",
            text: "Deleted"
        });
        </script>';
        header("refresh:1;");
    }else{
        echo 'error';
    }
}

?>




<?php
include 'src/init.php';

if (isset($_POST['editcomplainbtn'])) {
    $complainID = $strip->strip($_POST['complain_id']);
    $complainlm = $strip->strip($_POST['landmark']);
    $complain_desc = $strip->strip($_POST['complaint_desc']);
    
    $sql = "UPDATE complaint_tbl SET landmark = '$complainlm', complaint_desc = '$complain_desc' WHERE complain_id = '$complainID'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo '<script> 
                swal.fire({
                    icon: "success",
                    title: "Change has been Saved!",
                    text: "Click OK to refresh the page.",
                    type: "success"
                }).then(function(){
                    window.location="complain.php";
                });
              </script>';
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>


</div>
<script>
    // $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
        //     columns: [
        //         { data: 'Complain No.', defaultContent: 'No Data Available' }, // Example default content
        //         { data: 'Email', defaultContent: 'No Data Available' }, // Example default content
        //         { data: 'Landmark', defaultContent: 'No Data Available' }, // Example default content
        //         { data: 'Meter Serial No.', defaultContent: 'No Data Available' }, // Example default content
        //         { data: 'Pole No.', defaultContent: 'No Data Available' }, // Example default content
        //         { data: 'Details', defaultContent: 'No Data Available' }, // Example default content
        //         { 
        //             data: 'Status',
        //             defaultContent: 'No Data Available' // Provide an automatic value or leave it empty for null
        //         }
        //     ],
        //     suppressWarnings: true // This will hide DataTables warnings
        // });
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