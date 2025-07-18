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
            <h6 class="m-0 font-weight-bold text-white">Add PDF rates</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add PDF Rates </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                                                   

                    <div class="form-group">
    <label for="rate_type">Rate Type:</label>
    <select class="form-control" id="rate_type" name="rate_type" required>
        <option value="Generation Charge">Generation Charge</option>
         <option value="Unbundled Rate">Unbundled Rate</option>
       
    </select>
</div>

                    <div class="form-group">

                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pdf" name="pdf" accept=".pdf">

                                        <label class="custom-file-label" for="pdf">Choose Your PDF</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('pdf').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<div class="form-group">
                        <label for="curdate">Select Date Of File:</label>
                        <input type="date" class="form-control" id="curdate" name="curdate" required>
                    </div>

<button type="submit" name="addratebtn" class="btn btn-primary">Submit</button>
<?php
include 'src/init.php';

if (isset($_POST['addratebtn'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $newsUploadDirectory = 'assets/img/pdfrates/';
    $news_picture = $_FILES['pdf']; //input name
    $rate_type = $_POST['rate_type'];
    $date = $_POST['curdate'];
   
   
    if ($news_picture['error'] === UPLOAD_ERR_OK) {
      
        $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
        $newsFilepath = $newsUploadDirectory . $newspixFilename;

        if (move_uploaded_file($news_picture['tmp_name'], $newsFilepath)) {
            
            $newsInsert = $qrys->insert('rates', array(
                'pdf' => $newsFilepath,
                'date' => $date,
                'type_of_rate' => $rate_type
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add New Rate'
                ));

                if($logsQuery)
                echo' <script> swal.fire({
                    icon: "success",
                   title: "Change has been Saved!",
                   text: "Click ok to refresh the page.",
                   type: "success"
                 }).then(function(){
                   window.location="add_rate.php";
                 });
                 </script>';

                
            } else {
              
            }
        } else {
           
            echo "Failed to move the uploaded file!";
        }
    } else {
        
        echo "Failed to upload news picture. Error code: " . $news_picture['error'];
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

function get_alls_rates() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM rates ORDER BY date";
            
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

$allrates = get_alls_rates();
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>PDF</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>PDF</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $allrates = get_alls_rates();

                        if ($allrates) {
                            foreach ($allrates as $rates) : ?>
                                <tr>
                                    
                                <td>
            <a href='<?= $rates['pdf']; ?>' target='_blank'
               style='text-decoration: none; padding-left: 60px; background: url(img/pdflogo.png) no-repeat left center; background-size: 50px auto;'> <?php echo $rates['pdf'];?>
            </a>
        </td>
        
                        
                               

                        <td>
   
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $rates['rate_id']; ?>">
    <i class="fas fa-edit"></i>
</button>


                        <div class="modal fade" id="editModal<?= $rates['rate_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabeleditModal<?= $rates['rate_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal<?= $rates['rate_id']; ?>">Add PDF Rates </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" name="rate_id" value="<?php echo $rates['rate_id']; ?>">    
                    <div class="form-group">
                        <label for="file_title">File Title:</label>
                        <input type="text" class="form-control" id="file_title" name="file_title" required>
                    </div>
                    
                    <div class="form-group">
    <label for="award_type">Rate Type:</label>
    <select class="form-control" id="award_type" name="award_type" required>
        <option value="">Select Award Type</option>
        <option value="Generation Charge">Generation Charge</option>
         <option value="Unbundled Rate">Unbundled Rate</option>
       
    </select>
</div>

                    <div class="form-group">

                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pdfedit" name="pdfedit" accept=".pdf">

                                        <label class="custom-file-label" for="pdfedit">Choose Your PDF</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('pdfedit').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
<div class="modal-footer">
<button type="submit" name="editratebtn" class="btn btn-primary">Submit</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $rates['rate_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $rates['rate_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $rates['rate_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $rates['rate_id']; ?>"> Delete PDF Rate </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this PDF? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   

                    <input type="hidden" class="form-control" id="rate_id" name="rate_id" value="<?= $rates['rate_id']; ?>">

                  


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
    $rate_id = $_POST["rate_id"];
    
    $sql = "DELETE FROM rates WHERE rate_id = '$rate_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        echo '<script> swal.fire({
            icon: "success",
            title: "PDF Deleted"
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

if (isset($_POST['editratebtn'])) {
    $employeeID = $strip->strip($_POST['employee_id']);
    $File_title = $strip->strip($_POST['file_title']);
    $rateID = $strip->strip($_POST['rate_id']);
    $newpdf = $_FILES['pdf'];

    
    if ($_FILES['pdfedit']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/pdfrates/';
        $newFilename = $_FILES['pdfedit']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

      
        if (move_uploaded_file($_FILES['pdfedit']['tmp_name'], $newFilePath)) {
            // Start database transaction
            mysqli_begin_transaction($con);

            // Delete old rate entry
            $deleteSql = "DELETE FROM rates WHERE rate_id = '$rateID'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
                // Insert new rate entry
                $insertSql = "INSERT INTO rates (pdf, file_title) VALUES ('$newFilePath', '$File_title')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                    // Insert into logs
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit PDF')";
                    $logResult = mysqli_query($con, $logSql);
                    
                    if ($logResult) {
                        // Commit transaction
                        mysqli_commit($con);
                        echo '<script> 
                                swal.fire({
                                    icon: "success",
                                    title: "Change has been Saved!",
                                    text: "Click ok to refresh the page.",
                                    type: "success"
                                }).then(function(){
                                    window.location="add_rate.php";
                                });
                            </script>';
                    } else {
                        // Rollback transaction on failure
                        mysqli_rollback($con);
                        echo "Error inserting into logs: " . mysqli_error($con);
                    }
                } else {
                    // Rollback transaction on failure
                    mysqli_rollback($con);
                    echo "Error inserting new rate: " . mysqli_error($con);
                }
            } else {
                // Rollback transaction on failure
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