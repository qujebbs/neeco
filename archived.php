
<?php include "sidebar.php" ?>
<!DOCTYPE html>
<html lang="en">

<?php include "views/fragments/metadata.php"; ?>

<?php
              $town_code = $peracc[0]['city'];
              if($town_code == 'SANTO DOMINGO' ){
                 $town_code = "SD";
              } 
              if($town_code == 'TALAVERA' ){
                 $town_code = "TAL";
              } 
              if($town_code == 'ALIAGA' ){
                $town_code = "ALG";
             } 
             if($town_code == 'TALUGTUG' ){
                $town_code = "TALG";
             } 
             if($town_code == 'GUIMBA' ){
                $town_code = "GMB";
             } 
             if($town_code == 'CARRANGLAN' ){
                $town_code = "CRN";
             } 
             if($town_code == 'LICAB' ){
                $town_code = "LIC";
             } 
             if($town_code == 'SCIENCE CITY OF MUÑOZ' ){
                $town_code = "MNZ";
             } 
             if($town_code == 'LUPAO' ){
                $town_code = "LUP";
             } 
             if($town_code == 'QUEZON' ){
                $town_code = "QZN";
             } 
              

              ?>

<div class="container-fluid">

<!-- Page Heading -->


<!-- DataTales Example -->

<!-- DataTales Example -->



<?php 

function get_archive_consumer() {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN user_tbl ON consumer_tbl.consumer_id = user_tbl.consumer_id
         WHERE user_tbl.is_verified = 3";


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
<?php
$consumerarchived = get_archive_consumer();
?> 







<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ConsumerID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Cp No</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Complaint ID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Cp No</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($consumerarchived as $complain): ?>
                    <tr>
                        <td><?= $complain['consumer_id']; ?></td>
                        <td><?= $complain['firstname']; ?> <?= $complain['lastname']; ?></td>
                        <td><?= $complain['account_num']; ?></td>
                        <td><?= $complain['city']; ?>, <?= $complain['barangay']; ?></td>
                        <td><?= $complain['email']; ?></td>
                        <td><?= $complain['cpnum']; ?></td>
                        <td> Archived </td>
                        <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?= $complain['consumer_id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<div class="modal fade" id="editModal<?= $complain['consumer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $complain['consumer_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Retrieve User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    

                    Are you  sure you want to retrieve this user?
                    
                    <form action="" method="POST">

                    <input type="hidden" id="consumer_id" name="consumer_id" value="<?= $complain['consumer_id']; ?>">

                    <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    <a href="archived.php" class="btn btn-danger">Back</a>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

                </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php
include 'src/db.php';

if(isset($_POST['submit'])){
    $consumer_id = $_POST["consumer_id"];
    echo $consumer_id;
    $sql = "UPDATE user_tbl SET is_verified = 1 WHERE consumer_id = '$consumer_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        echo '<script> swal.fire({
            icon: "success",
            title: "TITLE:The comeback"
        });
        </script>';
        header("refresh:1;");
    }else{
        echo 'error';
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