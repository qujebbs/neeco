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
            <h6 class="m-0 font-weight-bold text-white">BAC Pdf</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">BAC Pdf </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                                                   
                    <div class="form-group">
                        <label for="file_title">File Title:</label>
                        <input type="text" class="form-control" id="file_title" name="file_title" required>
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

<button type="submit" name="addratebtn" class="btn btn-primary">Submit</button>
<?php
include 'src/init.php';

if (isset($_POST['addratebtn'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $newsUploadDirectory = 'assets/img/BAC/';
    $news_picture = $_FILES['pdf'];
    $file_name = $_POST['file_title'];


   
    if ($news_picture['error'] === UPLOAD_ERR_OK) {
      
        $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
        $newsFilepath = $newsUploadDirectory . $newspixFilename;

        

       
        if (move_uploaded_file($news_picture['tmp_name'], $newsFilepath)) {
            
            $newsInsert = $qrys->insert('bac', array(
                'bac_name' => $newsFilepath,
                'bac_title' => $file_name
                
                
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add BAC pdf'
                ));

                if($logsQuery)
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Success Added PDF File",
                    text: "Successfully Added New Quick Downloads PDF file"
                });
                </script>';
                header("refresh:1;");

                
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
            FROM bac";
            
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
                <th>BAC Title</th>
                <th>BAC PDF</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>BAC Title</th>
                <th>BAC PDF</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $allrates = get_alls_rates();

                        if ($allrates) {
                            foreach ($allrates as $rates) : ?>
                                <tr>
                                  <td><?= $rates['bac_title']; ?></td>  
                                <td>
            <a href='<?= $rates['bac_name']; ?>' target='_blank'
               style='text-decoration: none; padding-left: 60px; background: url(img/pdflogo.png) no-repeat left center; background-size: 50px auto;'> <?php echo $rates['bac_name'];?>
            </a>
        </td>
        
                               
                               

                        <td>
   
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $rates['bac_id']; ?>">
    <i class="fas fa-edit"></i>
</button>


                        <div class="modal fade" id="editModal<?= $rates['bac_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabeleditModal<?= $rates['bac_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal<?= $rates['bac_id']; ?>">Edit BAC PDF </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" name="bac_id" value="<?= $rates['bac_id']; ?>">    
                    <div class="form-group">
                        <label for="bac_title">File Title:</label>
                        <input type="text" class="form-control" id="bac_title" name="bac_title" required>
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



<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $rates['bac_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $rates['bac_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $rates['rate_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $rates['bac_id']; ?>"> Delete PDF BAC </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this BAC PDF? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   

                    <input type="hidden" class="form-control" id="bac_id" name="bac_id" value="<?= $rates['bac_id']; ?>">
                    <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">
                  


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
    $employeeID = $_POST["employee_id"];
    $bac_id = $_POST["bac_id"];
    
    $sql = "DELETE FROM bac WHERE bac_id = '$bac_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Delete BAC Pdf')";
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
                                    window.location="bac.php";
                                });
                            </script>';
                    }
    }else{
        echo 'error';
    }
}
    

?>

<?php
include 'src/init.php';

if (isset($_POST['editratebtn'])) {
    $employeeID = $strip->strip($_POST['employee_id']);
    $bac_title = $strip->strip($_POST['bac_title']);
    $bacID = $strip->strip($_POST['bac_id']);
    $newpdf = $_FILES['pdf'];

    
    if ($_FILES['pdfedit']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/BAC/';
        $newFilename = $_FILES['pdfedit']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

      
        if (move_uploaded_file($_FILES['pdfedit']['tmp_name'], $newFilePath)) {
           
            mysqli_begin_transaction($con);

           
            $deleteSql = "DELETE FROM bac WHERE bac_id = '$bacID'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
               
                $insertSql = "INSERT INTO bac (bac_name, bac_title) VALUES ('$newFilePath', '$bac_title')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                   
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit BACpdf')";
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
                                    window.location="bac.php";
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