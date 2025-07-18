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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Add Consumer Prompt</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Consumer Prompt </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                                                   
                    <div class="form-group">
                        <label for="consumer_name">Consumer Name:</label>
                        <input type="text" class="form-control" id="consumer_name" name="consumer_name" required>
                    </div>

                    <div class="form-group">
                        <label for="consumer_address">Consumer Address:</label>
                        <input type="text" class="form-control" id="consumer_address" name="consumer_address" required>
                    </div>

                  




<button type="submit" name="addstaffbtn" class="btn btn-primary">Submit</button>
<?php
include 'src/init.php';

if (isset($_POST['addstaffbtn'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $consumer_name = $strip->strip($_POST['consumer_name']);
    $consumer_address = $strip->strip($_POST['consumer_address']);
            
            $newsInsert = $qrys->insert('consumer_prompt_payers', array(
                'payer_name' => $consumer_name,
                'payer_address' => $consumer_address
                
                
                
                
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add New Consumer Prompt Payers'
                ));

                if($logsQuery)
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Success Payers ",
                    text: "Successfully Added Payers"
                });
                </script>';
                header("refresh:1;");

                
            } else {
              
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

function get_all_bod() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM consumer_prompt_payers";
            
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

$allbod = get_all_bod();
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
               
                <th>Prompt Payer Name</th>
                <th>Prompt Payer Address</th>
                
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
               
                <th>Prompt Payer Name</th>
                <th>Prompt Payer Address</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $allbod = get_all_bod();

                        if ($allbod) {
                            foreach ($allbod as $bod) : ?>
                                <tr>
                              
                                <td>
                                <?= $bod['payer_name']; ?>
        </td>
        <td><?= $bod['payer_address']; ?></td>
       
                               
                               

                        <td>
   




<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $bod['staff_id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<div class="modal fade" id="editModal<?= $bod['staff_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $bod['bod_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $bod['staff_id']; ?>"> Delete Board Directors </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                
                    <form action="" method="POST" enctype="multipart/form-data">
                   

                    <div class="form-group">
                        <label for="staff_ename">Staff Name:</label>
                        <input type="text" class="form-control" id="staff_ename" name="staff_ename"value="<?= $bod['staff_name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="staff_eposition">Staff Position:</label>
                        <input type="text" class="form-control" id="staff_eposition" name="staff_eposition" value="<?= $bod['staff_position']; ?>"required>
                    </div>

                    <div class="form-group">
                        <label for="staff_edepartment">Staff Department:</label>
                        <input type="text" class="form-control" id="staff_edepartment" name="staff_edepartment" value="<?= $bod['staff_department']; ?>"required>
                    </div>

                    <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="estaffpix" name="estaffpix" accept="image/*">
                                        <label class="custom-file-label" for="estaffpix">Choose Staff Picture</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('estaffpix').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>






                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" class="form-control" id="staff_id" name="staff_id" value="<?= $bod['staff_id']; ?>">

                  


<div class="modal-footer">
<button type="submit" name="editpdfbtn" class="btn btn-primary">Submit</button>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $bod['staff_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $bod['staff_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $bod['bod_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $bod['staff_id']; ?>"> Delete Board Directors </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this Board Director? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" class="form-control" id="staff_id" name="staff_id" value="<?= $bod['staff_id']; ?>">

                  


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
    $staff_id = $_POST["staff_id"];
    $employee_id = $_POST["employee_id"];

    $sql = "DELETE FROM staff WHERE staff_id = '$staff_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        $logsQuery = $qrys->insert('logs_tbl', array(
            'employee_id' => $employee_id,
            'log_activity' => 'Delete Staff'
        ));

        if($logsQuery)
        echo '<script> swal.fire({
            icon: "success",
            title: "Staff Deleted ",
            text: "Staff has been deleted"
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

if (isset($_POST['editpdfbtn'])) {
    $employeeID = $strip->strip($_POST['employee_id']);
    $staff_id = $strip->strip($_POST['staff_id']);
    $staffname = $strip->strip($_POST['staff_ename']);
    $staffpost = $strip->strip($_POST['staff_eposition']);
    $staffdept = $strip->strip($_POST['staff_edepartment']);
    $enewpdf = $_FILES['estaffpix'];

    
    if ($_FILES['estaffpix']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/pdfrates/';
        $newFilename = $_FILES['estaffpix']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

      
        if (move_uploaded_file($_FILES['estaffpix']['tmp_name'], $newFilePath)) {
            
            mysqli_begin_transaction($con);

           
            $deleteSql = "DELETE FROM staff WHERE staff_id = '$staff_id'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
               
                $insertSql = "INSERT INTO staff (staff_name, staff_position, staff_department, staff_picture) VALUES ('$staffname', '$staffpost', '$staffdept', '$newFilePath')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                    
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit Staff')";
                    $logResult = mysqli_query($con, $logSql);
                    
                    if ($logResult) {
                        
                        mysqli_commit($con);
                        echo '<script> 
                                swal.fire({
                                    icon: "success",
                                    title: "Change has been Saved!",
                                    text: "Click ok to refresh the page.",
                                    type: "success"
                                }).then(function(){
                                    window.location="staff.php";
                                });
                            </script>';
                    } else {
                        
                        mysqli_rollback($con);
                        echo "Error inserting into logs: " . mysqli_error($con);
                    }
                } else {
                    
                    mysqli_rollback($con);
                    echo "Error inserting new rate: " . mysqli_error($con);
                }
            } else {
                
                mysqli_rollback($con);
                echo "Error deleting old rate: " . mysqli_error($con);
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Error uploading file.";
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