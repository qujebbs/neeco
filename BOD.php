<?php
include "sidebar.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> 
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>

<div class="container-fluid">

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <h6 class="m-0 font-weight-bold text-white">Add Board Of Directors</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Board Of Directors </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                                                   
                    <div class="form-group">
                        <label for="bod_name">BOD Name:</label>
                        <input type="text" class="form-control" id="bod_name" name="bod_name" required>
                    </div>

                    <div class="form-group">
                        <label for="bod_position">BOD Position:</label>
                        <input type="text" class="form-control" id="bod_position" name="bod_position" required>
                    </div>

                    <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="BODpix" name="BODpix" accept="image/*">
                                        <label class="custom-file-label" for="BODpix">Choose Board Picture</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('BODpix').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<?php $allcourse =$qrys->selectall('town_tbl'); 


?> 

<div class="form-group">

                    
               
                    <select class="form-select" name="bod_town" aria-label="Default select example" required="required">
                      
                      <option selected disabled>City</option>
         <?php for($allc=0;$allc<count($allcourse);$allc++){ ?>
            <option value="<?php echo $allcourse[$allc]['town_id']?>"><?php echo $allcourse[$allc]['town_name']?></option>

            <?php } ?>
                    </select>
                  </div>


<button type="submit" name="addbodbtn" class="btn btn-primary">Submit</button>
<?php
include 'src/init.php';

if (isset($_POST['addbodbtn'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $bod_name = $strip->strip($_POST['bod_name']);
    $bod_post = $strip->strip($_POST['bod_position']);
    $bod_town = $strip->strip($_POST['bod_town']);
    $newsUploadDirectory = 'assets/img/BOD/';
    $news_picture = $_FILES['BODpix'];
    $file_name = $_POST['file_title'];


   
    if ($news_picture['error'] === UPLOAD_ERR_OK) {
      
        $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
        $newsFilepath = $newsUploadDirectory . $newspixFilename;

        

       
        if (move_uploaded_file($news_picture['tmp_name'], $newsFilepath)) {
            
            $newsInsert = $qrys->insert('bod_tbl', array(
                'bod_name' => $bod_name,
                'bod_position' => $bod_post,
                'bod_picture' => $newsFilepath,
                'town_id' => $bod_town
                
                
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add New Board Of Director'
                ));

                if($logsQuery)
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Success Added BOD ",
                    text: "Successfully Added Board Directors"
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

function get_all_bod() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM bod_tbl 
            JOIN town_tbl ON bod_tbl.town_id = town_tbl.town_id";
            
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
                <th>Picture</th>
                <th>Board Director Name</th>
                <th>Position</th>
                <th>District</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Picture</th>
                    <th>Board Director Name</th>
                <th>Position</th>
                <th>District</th>
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
                 <img src="<?= $bod['bod_picture']; ?>" alt="alternative_text" style="height: 100px;">
                    </td>

                                <td>
                                <?= $bod['bod_name']; ?>
        </td>
        <td><?= $bod['bod_position']; ?></td>
        <td> <?= $bod['town_name']; ?> </td>
                               
                               

                        <td>
   




<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $bod['bod_id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<div class="modal fade" id="editModal<?= $bod['bod_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $bod['bod_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $bod['bod_id']; ?>"> Delete Board Directors </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                
                    <form action="" method="POST" enctype="multipart/form-data">
                   

                    <div class="form-group">
                        <label for="bod_ename">BOD Name:</label>
                        <input type="text" class="form-control" id="bod_ename" name="bod_ename"value="<?= $bod['bod_name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="bod_eposition">BOD Position:</label>
                        <input type="text" class="form-control" id="bod_eposition" name="bod_eposition" value="<?= $bod['bod_position']; ?>"required>
                    </div>

                    <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="eBODpix" name="eBODpix" accept="image/*">
                                        <label class="custom-file-label" for="eBODpix">Choose Board Picture</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('eBODpix').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<?php $allcourse =$qrys->selectall('town_tbl'); 


?> 

<div class="form-group">

                    
               
                    <select class="form-select" name="ebod_town" aria-label="Default select example" required="required">
                      
                      <option selected disabled>City</option>
         <?php for($allc=0;$allc<count($allcourse);$allc++){ ?>
            <option value="<?php echo $allcourse[$allc]['town_id']?>"><?php echo $allcourse[$allc]['town_name']?></option>

            <?php } ?>
                    </select>
                  </div> 


                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" class="form-control" id="ebod_id" name="ebod_id" value="<?= $bod['bod_id']; ?>">

                  


<div class="modal-footer">
<button type="submit" name="editpdfbtn" class="btn btn-primary">Submit</button>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $bod['bod_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $bod['bod_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $bod['bod_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $bod['bod_id']; ?>"> Delete Board Directors </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this Board Director? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" class="form-control" id="bod_id" name="bod_id" value="<?= $bod['bod_id']; ?>">

                  


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
    $bod_id = $_POST["bod_id"];
    $employee_id = $_POST["employee_id"];

    $sql = "DELETE FROM bod_tbl WHERE bod_id = '$bod_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        $logsQuery = $qrys->insert('logs_tbl', array(
            'employee_id' => $employee_id,
            'log_activity' => 'Delete Board Director'
        ));

        if($logsQuery)
        echo '<script> swal.fire({
            icon: "success",
            title: "Board Director Deleted ",
            text: "The Board Directors has been deleted"
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
    $bodID = $strip->strip($_POST['ebod_id']);
    $bodName = $strip->strip($_POST['bod_ename']);
    $bodPost = $strip->strip($_POST['bod_eposition']);
    $bodtown = $strip->strip($_POST['ebod_town']);
    $enewpdf = $_FILES['eBODpix'];

    
    if ($_FILES['eBODpix']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/pdfrates/';
        $newFilename = $_FILES['eBODpix']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

      
        if (move_uploaded_file($_FILES['eBODpix']['tmp_name'], $newFilePath)) {
            
            mysqli_begin_transaction($con);

           
            $deleteSql = "DELETE FROM bod_tbl WHERE bod_id = '$bodID'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
               
                $insertSql = "INSERT INTO bod_tbl (bod_name, bod_position, bod_picture, town_id) VALUES ('$bodName', '$bodPost', '$newFilePath', '$bodtown')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                    
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit Board Of Directors')";
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
                                    window.location="BOD.php";
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