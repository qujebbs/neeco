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
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                <h6 class="m-0 font-weight-bold text-white">Add Staff</h6>
            </button>
        </div>

        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php
                    $modelLabel = "addUserModalLabel";
                    $title = "Add Staff";

                    include "views/fragments/modalHeader.php";
                    ?>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">

                            <div class="form-group">
                                <label for="staff_department">Staff Department:</label>
                                <input type="text" class="form-control" id="staff_department" name="staff_department"
                                    required>
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="staffpix" name="staffpix"
                                        accept="image/*">
                                    <label class="custom-file-label" for="staffpix">Choose Board Picture</label>
                                </div>
                            </div>
                            <script>
                                document.getElementById('staffpix').addEventListener('change', function (e) {
                                    var fileName = e.target.files[0].name;
                                    var nextSibling = e.target.nextElementSibling;
                                    nextSibling.innerText = fileName;
                                });
                            </script>

                            <button type="submit" name="addstaffbtn" class="btn btn-primary">Submit</button>
                            <?php
                            include 'src/init.php';

                            if (isset($_POST['addstaffbtn'])) {

                                $employee_id = $strip->strip($_POST['employee_id']);

                                $staff_dpt = $strip->strip($_POST['staff_department']);

                                $newsUploadDirectory = 'assets/img/staff/';
                                $staff_picture = $_FILES['staffpix'];

                                if ($staff_picture['error'] === UPLOAD_ERR_OK) {

                                    $newspixFilename = uniqid() . '_' . basename($staff_picture['name']);
                                    $newsFilepath = $newsUploadDirectory . $newspixFilename;

                                    if (move_uploaded_file($staff_picture['tmp_name'], $newsFilepath)) {

                                        $newsInsert = $qrys->insert('staff', array(
                                            'staff_department' => $staff_dpt,
                                            'staff_picture' => $newsFilepath

                                        ));


                                        if ($newsInsert) {
                                            $logsQuery = $qrys->insert('logs_tbl', array(
                                                'employee_id' => $employee_id,
                                                'log_activity' => 'Add New Board Of Staff'
                                            ));

                                            if ($logsQuery)
                                                echo '<script> swal.fire({
                    icon: "success",
                    title: "Success Added Staff ",
                    text: "Successfully Added Staff"
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
    include "database/staffs.db.php";

    $allbod = get_all_staff();
    ?>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Picture</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php

                    $allbod = get_all_staff();
  
                    if ($allbod) {
                        foreach ($allbod as $bod): ?>
                            <tr>
                                <td>
                                    <img src="<?= $bod['staff_picture']; ?>" alt="alternative_text" style="height: 100px;">
                                </td>

                                <td> <?= $bod['staff_department']; ?> </td>

                                <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editModal<?= $bod['staff_id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <div class="modal fade" id="editModal<?= $bod['staff_id']; ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel<?= $bod['staff_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?= $bod['staff_id']; ?>"> Delete
                                                        Board Directors </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="" method="POST" enctype="multipart/form-data">

                                                        <div class="form-group">
                                                            <label for="staff_edepartment">Staff Department:</label>
                                                            <input type="text" class="form-control" id="staff_edepartment"
                                                                name="staff_edepartment"
                                                                value="<?= $bod['staff_department']; ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="estaffpix"
                                                                    name="estaffpix" accept="image/*">
                                                                <label class="custom-file-label" for="estaffpix">Choose Staff
                                                                    Picture</label>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            document.getElementById('estaffpix').addEventListener('change', function (e) {
                                                                var fileName = e.target.files[0].name;
                                                                var nextSibling = e.target.nextElementSibling;
                                                                nextSibling.innerText = fileName;
                                                            });
                                                        </script>

                                                        <input type="hidden" name="employee_id"
                                                            value="<?php echo $peracc[0]['employee_id']; ?>">
                                                        <input type="hidden" class="form-control" id="staff_id" name="staff_id"
                                                            value="<?= $bod['staff_id']; ?>">

                                                        <div class="modal-footer">
                                                            <button type="submit" name="editpdfbtn"
                                                                class="btn btn-primary">Submit</button>
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

                <div class="modal fade" id="deleteModal<?= $bod['staff_id']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel<?= $bod['staff_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel<?= $bod['staff_id']; ?>"> Delete Board Directors
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                Are You sure you want to delete this Board Director? this action cannot be undone
                                <form action="" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="employee_id" value="<?php echo $peracc[0]['employee_id']; ?>">
                                    <input type="hidden" class="form-control" id="staff_id" name="staff_id"
                                        value="<?= $bod['staff_id']; ?>">




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

if (isset($_POST['dltpdfbtn'])) {
    $staff_id = $_POST["staff_id"];
    $employee_id = $_POST["employee_id"];

    $sql = "DELETE FROM staff WHERE staff_id = '$staff_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $logsQuery = $qrys->insert('logs_tbl', array(
            'employee_id' => $employee_id,
            'log_activity' => 'Delete Staff'
        ));

        if ($logsQuery)
            echo '<script> swal.fire({
            icon: "success",
            title: "Staff Deleted ",
            text: "Staff has been deleted"
        });
        </script>';
        header("refresh:1;");
    } else {
        echo 'error';
    }
}

?>

<?php
include 'src/init.php';

if (isset($_POST['editpdfbtn'])) {
    $employeeID = $strip->strip($_POST['employee_id']);
    $staff_id = $strip->strip($_POST['staff_id']);
    // $staffname = $strip->strip($_POST['staff_ename']);
    // $staffpost = $strip->strip($_POST['staff_eposition']);
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