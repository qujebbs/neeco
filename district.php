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
            <h6 class="m-0 font-weight-bold text-white">Add District Office</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add District Office </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                                                   
                    <div class="form-group">
                        <label for="bod_name">District Name:</label>
                        <input type="text" class="form-control" id="district_name" name="district_name" required>
                    </div>

                    <div class="form-group">
                        <label for="bod_position">Hotline:</label>
                        <input type="text" class="form-control" id="hotline" name="hotline" required>
                    </div>

                    <div class="form-group">
                        <label for="bod_position">CP Num.:</label>
                        <input type="text" class="form-control" id="cpnum" name="cpnum" required>
                    </div>

                    <div class="form-group">
                        <label for="bod_position">DCSO:</label>
                        <input type="text" class="form-control" id="dcso" name="dcso" required>
                    </div>

                    <div class="form-group">
                        <label for="bod_position">Teller:</label>
                        <textarea type="text" class="form-control" id="teller" name="teller" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="bod_position">Station Lineman:</label>
                        <textarea type="text" class="form-control" id="lineman" name="lineman" required></textarea>
                    </div>
                    <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="BODpix" name="BODpix" accept="image/*">
                                        <label class="custom-file-label" for="BODpix">Choose District Picture</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('BODpix').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>



<button type="submit" name="adddistrictbtn" class="btn btn-primary">Submit</button>
<?php
include 'src/init.php';

if (isset($_POST['adddistrictbtn'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $district_name = $strip->strip($_POST['district_name']);
    $hotline = $strip->strip($_POST['hotline']);
    $cpnum = $strip->strip($_POST['cpnum']);
    $dcso = $strip->strip($_POST['dcso']);
    $teller = $strip->strip($_POST['teller']);
    $lineman = $strip->strip($_POST['lineman']);
    $newsUploadDirectory = 'assets/img/districtoffice/';
    $news_picture = $_FILES['BODpix'];
    


   
    if ($news_picture['error'] === UPLOAD_ERR_OK) {
      
        $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
        $newsFilepath = $newsUploadDirectory . $newspixFilename;

        

       
        if (move_uploaded_file($news_picture['tmp_name'], $newsFilepath)) {
            
            $newsInsert = $qrys->insert('district_office', array(
                'district_name' => $district_name,
                'hotline' => $hotline,
                'cpnum' => $cpnum,
                'DCSO' => $dcso,
                'teller' => $teller,
                'station_lineman' => $lineman,
                'district_pic' => $newsFilepath
                
                
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add New District Office'
                ));

                if($logsQuery)
                echo '<script> swal.fire({
                    icon: "success",
                    title: "Success Added District Office ",
                    text: "Successfully Added District Office"
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

function get_all_district() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM district_office";
            
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

$alldist = get_all_district();
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>District Picture</th>
                <th>District Name</th>
                <th>Hotline</th>
                <th>Cellphone No.</th>
                <th>DCSO</th>
                <th>District Teller</th>
                <th>District Lineman</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>District Picture</th>
                <th>District Name</th>
                <th>Hotline</th>
                <th>Cellphone No.</th>
                <th>DCSO</th>
                <th>District Teller</th>
                <th>District Lineman</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $alldist = get_all_district();

                        if ($alldist) {
                            foreach ($alldist as $district) : ?>
                                <tr>
                                <td>
                 <img src="<?= $district['district_pic']; ?>" alt="alternative_text" style="height: 100px;">
                    </td>

                                <td>
                                <?= $district['district_name']; ?>
        </td>
        <td><?= $district['hotline']; ?></td>
        <td> <?= $district['cpnum']; ?> </td>
        <td> <?= $district['DCSO']; ?> </td>
        <td class="text-break"> <?= $district['teller']; ?> </td>
        <td class="text-break"> <?= $district['station_lineman']; ?> </td>
                               
                               

                        <td>
   




<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $district['district_id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<div class="modal fade" id="editModal<?= $district['district_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $district['district_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $district['district_id']; ?>"> Edit District Office </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                <form action="" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>"> 
                    <input type="hidden" name="district_id" value="<?= $district['district_id']; ?>">   
                                                   
                    <div class="form-group">
                        <label for="edistrict_name">District Name:</label>
                        <input type="text" class="form-control" id="edistrict_name" name="edistrict_name" value="<?= $district['district_name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="ehotline">Hotline:</label>
                        <input type="text" class="form-control" id="ehotline" name="ehotline" value="<?= $district['hotline']; ?> "required>
                    </div>

                    <div class="form-group">
                        <label for="ecpnum">CP Num.:</label>
                        <input type="text" class="form-control" id="ecpnum" name="ecpnum" value="<?= $district['cpnum']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="edcso">DCSO:</label>
                        <input type="text" class="form-control" id="edcso" name="edcso" value="<?= $district['DCSO']; ?>"required>
                    </div>

                    <div class="form-group">
                        <label for="eteller">Teller:</label>
                        <textarea type="text" class="form-control" id="eteller" name="eteller" ><?= $district['teller']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="elineman">Station Lineman:</label>
                        <textarea type="text" class="form-control" id="elineman" name="elineman"><?= $district['lineman']; ?></textarea>
                    </div>
                    <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="eBODpix" name="eBODpix" accept="image/*">
                                        <label class="custom-file-label" for="BODpix">Choose District Picture</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('eBODpix').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
                

                  


<div class="modal-footer">
<button type="submit" name="editdistbtn" class="btn btn-primary">Submit</button>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $district['district_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $district['district_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $district['district_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $district['district_id']; ?>"> Delete District Office </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                Are You sure you want to delete this District Office? this action cannot be undone
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">    
                    <input type="hidden" class="form-control" id="district_id" name="district_id" value="<?= $district['district_id']; ?>">

                  


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
    $dist_id = $_POST["district_id"];
    $employee_id = $_POST["employee_id"];

    $sql = "DELETE FROM district_office WHERE district_id = '$dist_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        $logsQuery = $qrys->insert('logs_tbl', array(
            'employee_id' => $employee_id,
            'log_activity' => 'Delete Office'
        ));

        if($logsQuery)
        echo '<script> swal.fire({
            icon: "success",
            title: " District Office Deleted ",
            text: "The District Office has been deleted"
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

if (isset($_POST['editdistbtn'])) {
    $employeeID = $strip->strip($_POST['employee_id']);
    $distID = $strip->strip($_POST['district_id']);
    $distName = $strip->strip($_POST['edistrict_name']);
    $distline = $strip->strip($_POST['ehotline']);
    $distcp = $strip->strip($_POST['ecpnum']);
    $DCSO = $strip->strip($_POST['edcso']);
    $distteller = $strip->strip($_POST['eteller']);
    $distlineman = $strip->strip($_POST['elineman']);
    $enewpdf = $_FILES['eBODpix'];

    
    if ($_FILES['eBODpix']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/districtoffice/';
        $newFilename = $_FILES['eBODpix']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

      
        if (move_uploaded_file($_FILES['eBODpix']['tmp_name'], $newFilePath)) {
            
            mysqli_begin_transaction($con);

           
            $deleteSql = "DELETE FROM district_office WHERE district_id = '$distID'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
               
                $insertSql = "INSERT INTO district_office (district_name, hotline, cpnum, DCSO, teller, station_lineman, district_pic) VALUES ('$distName', '$distline', '$distcp', '$DCSO', '$distteller', '$distlineman', '$newFilePath')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                    
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit District Office')";
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
                                    window.location="district.php";
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