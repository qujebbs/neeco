
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
            <h6 class="m-0 font-weight-bold text-white">Add Services</h6>
        </button>
    </div>

    
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Services</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">                                   
                     <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="service_pic" name="service_pic" accept="image/*">
                                        <label class="custom-file-label" for="news_picture">Choose News Picture</label>
                                    </div>
                                </div>
                                <script>
    document.getElementById('service_pic').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

    <div class="form-group">
    <label for="service_title">Service Title:</label>
    <textarea  class="form-control" id="service_title" name="service_title" required></textarea>
</div>



<div class="form-group">
    <label for="service_desc">Service Description/Content:</label>
    <textarea class="form-control" id="service_desc" name="service_desc" required></textarea>
</div>

    <input type="submit" name="submit">

    <?php
if (isset($_POST['submit'])) {
    
    $employee_id = $strip->strip($_POST['employee_id']);
    $service_title = $strip->strip($_POST['service_title']);
    $service_desc = $strip->strip($_POST['service_desc']);
    
    $newsUploadDirectory = 'assets/img/service/';
    $news_picture = $_FILES['service_pic'];

   
    if ($news_picture['error'] === UPLOAD_ERR_OK) {
      
        $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
        $newsFilepath = $newsUploadDirectory . $newspixFilename;

       
        if (move_uploaded_file($news_picture['tmp_name'], $newsFilepath)) {
            
            $newsInsert = $qrys->insert('services', array(
                'service_picture' => $newsFilepath,
                'service_title' => $service_title,
                'service_description' => $service_desc
            ));

            
            if ($newsInsert) {
                $logsQuery = $qrys->insert('logs_tbl', array(
                    'employee_id' => $employee_id,
                    'log_activity' => 'Add Services'
                ));

                if($logsQuery)
                echo' <script> swal.fire({
                    icon: "success",
                   title: "Change has been Saved!",
                   text: "Click ok to refresh the page.",
                   type: "success"
                 }).then(function(){
                   window.location="add_service.php";
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

function get_alls_service() {
    global $con;
    $list = array();

    $sql = "SELECT *
            FROM services";
            
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

$service = get_alls_service();
?>


                  
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>PICS</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>PICS</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                
                        <?php

                        
                        
                        $service = get_alls_service();

                        if ($service) {
                            foreach ($service as $news) : ?>
                                <tr>
                                    
                                <td><img src="<?= $news['service_picture']; ?>" style="height: 100px;"></td>
                                <td><?= $news['service_title']; ?></td>
                                <td class="text-break"><?= $news['service_description']; ?></td>
                               

                        <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewModal<?= $news['service_id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<div class="modal fade" id="viewModal<?= $news['service_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel<?= $news['service_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel<?= $news['service_id']; ?>">Edit Services </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                    <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo $peracc[0]['employee_id'];?>">
                    <input type="hidden" class="form-control" id="service_id" name="service_id" value="<?= $news['service_id']; ?>">

                    <div class="form-group">
    <label for="service_pix">Service Pic:</label>
    <input type="file" class="form-control" id="service_pix" name="service_pix">
</div>



<div class="form-group">
    <label for="service_title">Service Title:</label>
    <input type="input" class="form-control" id="service_title" name="service_title" value="<?= $news['service_title']; ?>">
</div>

<div class="form-group">
    <label for="service_desc">Service Description:</label>
    <input type="text" class="form-control" id="service_desc" name="service_desc" value="<?= $news['service_description']; ?>">
</div>



<button type="submit" name="editnewsbtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $news['service_id']; ?>">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="deleteModal<?= $news['service_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $news['service_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $news['service_id']; ?>">Delete News </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                   
                                    Are you sure yoou want to delete this news?
                    <input type="hidden" class="form-control" id="service_id" name="service_id" value="<?= $news['service_id']; ?>">

                


<div class="modal-footer">
<button type="submit" name="dltnewsbtn" class="btn btn-primary">Submit</button>
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
include 'src/init.php';


if (isset($_POST['dltnewsbtn'])) {
    $serviceID = $strip->strip($_POST['service_id']);
    
    $sql = "DELETE FROM services WHERE service_id = '$serviceID'";
    $result = mysqli_query($con, $sql);

    if($result){
        $emp_id = $peracc[0]['employee_id'];
        
        $loginsert = $qrys->insert('logs_tbl', array(
            'employee_id' => $emp_id,
            'log_activity' => 'DeleteServices'
        ));
        if($loginsert){

            echo' <script> swal.fire({
                    icon: "success",
                   title: "Service Deleted!",
                   text: "Click ok to refresh the page.",
                   type: "success"
                 }).then(function(){
                   window.location="add_service.php";
                 });
                 </script>';

         } 
    }
}
?>


<?php
include 'src/init.php';

if (isset($_POST['editnewsbtn'])) {
    $title = $strip->strip($_POST['service_title']);
    $serviceID = $strip->strip($_POST['service_id']);
    $description = $strip->strip($_POST['service_desc']);
    $employeeID = $strip->strip($_POST['employee_id']);

    
    if ($_FILES['service_pix']['error'] === UPLOAD_ERR_OK) {
        $newsUploadDirectory = 'assets/img/service/';
        $newFilename = $_FILES['service_pix']['name'];
        $newFilePath = $newsUploadDirectory . $newFilename;

        
        if (move_uploaded_file($_FILES['service_pix']['tmp_name'], $newFilePath)) {
           
            $deleteSql = "DELETE FROM services WHERE service_id = '$serviceID'";
            $deleteResult = mysqli_query($con, $deleteSql);
            if ($deleteResult) {
               
                $insertSql = "INSERT INTO services (service_picture, service_title, service_description) VALUES ('$newFilePath', '$title', '$description')";
                $insertResult = mysqli_query($con, $insertSql);
                if ($insertResult) {
                    
                    $logSql = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ('$employeeID', 'Edit Services')";
                    $logResult = mysqli_query($con, $logSql);
                    
                    if ($logResult) {
                        echo '<script> 
                            swal.fire({
                                icon: "success",
                                title: "Change has been Saved!",
                                text: "Click ok to refresh the page.",
                                type: "success"
                            }).then(function(){
                                window.location="add_service.php";
                            });
                        </script>';
                    } else {
                        echo "Error inserting log: " . mysqli_error($con);
                    }
                    
                } else {
                    echo "Error inserting new news: " . mysqli_error($con);
                }
            } else {
                echo "Error deleting old news: " . mysqli_error($con);
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