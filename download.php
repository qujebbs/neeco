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

<div class="container-fluid">

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Add Quick Downloads</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Quick Downloads </h5>
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
    $newsUploadDirectory = 'assets/img/quickdownloads/';
    $news_picture = $_FILES['pdf'];
    $file_name = $_POST['file_title'];


   
    if ($news_picture['error'] === UPLOAD_ERR_OK) {
      
        $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
        $newsFilepath = $newsUploadDirectory . $newspixFilename;

        

       
        if (move_uploaded_file($news_picture['tmp_name'], $newsFilepath)) {
            
            $newsInsert = $qrys->insert('downloads', array(
                'pdf_name' => $newsFilepath,
                'pdf_title' => $file_name
                
                
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add New Quick Downloads'
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

function get_alls_downloads() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM downloads";
            
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

$quickdownload = get_alls_downloads();
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>File Title</th>
                <th>Quick Downloads</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>File Title</th>
                <th>Quick Downloads</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $quickdownload = get_alls_downloads();

                        if ($quickdownload) {
                            foreach ($quickdownload as $dl) : ?>
                                <tr>
                                 <td><?= $dl['pdf_title']; ?></td>   
                                <td>
            <a href='<?= $dl['pdf_name']; ?>' target='_blank'
               style='text-decoration: none; padding-left: 60px; background: url(img/pdflogo.png) no-repeat left center; background-size: 50px auto;'> <?php echo $dl['pdf_name'];?>
            </a>
        </td>
        
                               
                               

                        <td>
   
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $dl['download_id']; ?>">
    <i class="fas fa-edit"></i>
</button>


                        <div class="modal fade" id="editModal<?= $dl['download_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabeleditModal<?= $dl['download_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal<?= $dl['download_id']; ?>">Edit Quick Downloads </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" name="download_id" value="<?= $dl['download_id']; ?>">    
                    <div class="form-group">
                        <label for="pdf_title">PDF Title:</label>
                        <input type="text" class="form-control" id="pdf_title" name="pdf_title" required>
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



<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $dl['download_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $dl['download_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $dl['download_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $dl['download_id']; ?>"> Delete PDF Rate </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this Quick Downloads? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                    <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo $peracc['employee_id']; ?>">
                    <input type="hidden" class="form-control" id="download_id" name="download_id" value="<?= $dl['download_id']; ?>">

                  


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
    $download_id = $_POST["download_id"];
    
    $sql = "DELETE FROM downloads WHERE download_id = '$download_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Delete Quick Downloads')";
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
                                    window.location="download.php";
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
    $pdf_title = $strip->strip($_POST['pdf_title']);
    $downloadID = $strip->strip($_POST['download_id']);
    $newpdf = $_FILES['pdfedit'];

    
    if ($_FILES['pdfedit']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/quickdownloads/';
        $newFilename = $_FILES['pdfedit']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

      
        if (move_uploaded_file($_FILES['pdfedit']['tmp_name'], $newFilePath)) {
            
            mysqli_begin_transaction($con);

           
            $deleteSql = "DELETE FROM downloads WHERE download_id = '$downloadID'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
               
                $insertSql = "INSERT INTO downloads (pdf_name, pdf_title) VALUES ('$newFilePath', '$pdf_title')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                  
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit Quick Downloads')";
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
                                    window.location="download.php";
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