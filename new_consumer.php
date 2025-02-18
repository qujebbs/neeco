
<?php
include "sidebar.php";




?>
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

function get_new_consumer() {
    global $con;
    $list = array();

    $sql = "SELECT *
         FROM consumer_tbl
         INNER JOIN user_tbl ON consumer_tbl.consumer_id = user_tbl.consumer_id
         INNER JOIN town_table ON consumer_tbl.town_code = town_table.town_code
         WHERE user_tbl.is_verified = 1";


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
$newconsumer = get_new_consumer();
?>            
          

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>MembershipID</th>
                    <th>BackMemberShip ID</th>
                    <th>Name</th>
                    <th>Account_num</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date and Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($newconsumer as $consumer): ?>
                    <tr>
                    <td>
    <a href="<?= $consumer['profilepix']; ?>"><img src="<?= $consumer['profilepix']; ?>" alt="Profile Picture" style="height: 100px;">
    </a>
</td>
<td>
    <a href="<?= $consumer['backpix']; ?>"><img src="<?= $consumer['backpix']; ?>" alt="Profile Picture" style="height: 100px;">
    </a>
</td>

                        <td><?= $consumer['firstname']; ?> <?= $consumer['lastname']; ?></td>
                        <td><?= $consumer['account_num']; ?></td>
                        <td><?= $consumer['barangay']; ?> <?= $consumer['town_description']; ?></td>
                        <td><?= $consumer['email']; ?></td>
                        <td style="color: <?= $consumer['is_verified'] == 1 ? 'red' : 'green'; ?>">
    <?= $consumer['is_verified'] == 1 ? 'Waiting for approval...' : 'Verified'; ?>
</td>

                        <td><?= date('F j, Y g:i A', strtotime($consumer['registration_date'])); ?></td>
                        <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#verifyModal<?= $consumer['consumer_id']; ?>">
    <i class="fas fa-check"></i>
</button>
<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#viewModal<?= $consumer['consumer_id']; ?>">
    <i class="fas fa-trash"></i>
</button>


<div class="modal fade" id="verifyModal<?= $consumer['consumer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="verifyModal<?= $consumer['consumer_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Verify User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    

                    Are you  sure you want to verified this user?
                    
                    <form action="" method="POST">

                    <input type="hidden" id="consumer_id" name="consumer_id" value="<?= $consumer['consumer_id']; ?>">

                    <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    <a href="new_consumer.php" class="btn btn-danger">Back</a>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal<?= $consumer['consumer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModal<?= $consumer['consumer_id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Archive User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    

                    Are you  sure you want to archive this user?
                    
                    <form action="" method="POST">

                    <input type="hidden" id="consumer_id" name="consumer_id" value="<?= $consumer['consumer_id']; ?>">

                    <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="archive" value="Submit">
                    <a href="new_consumer.php" class="btn btn-danger">Back</a>
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
    $sql = "UPDATE user_tbl SET is_verified = 2 WHERE consumer_id = '$consumer_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        echo '<script> swal.fire({
            icon: "success",
            title: "User verified!"
        });
        </script>';
        header("refresh:1;");
    }else{
        echo 'error';
    }
}


?>


<?php
include 'src/db.php';

if(isset($_POST['archive'])){
    $consumer_id = $_POST["consumer_id"];
    echo $consumer_id;
    $sql = "UPDATE user_tbl SET is_verified = 3 WHERE consumer_id = '$consumer_id'";
    $result = mysqli_query($con, $sql);

    if($result){
        echo '<script> swal.fire({
            icon: "success",
            title: "User Archived!"
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