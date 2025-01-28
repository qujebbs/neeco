<?php include 'sidebar.php'; ?>




<?php

include "src/db.php";

if(isset($_GET['complain_id'])){
$complain_id = $_GET['complain_id'];

$sql = "SELECT * FROM complaint_tbl 
JOIN consumer_tbl ON complaint_tbl.consumer_id = consumer_tbl.consumer_id 
JOIN town_tbl ON consumer_tbl.town_id = town_tbl.town_id WHERE complain_id = '$complain_id'
";
$result = mysqli_query($con, $sql);

if($result){
    foreach($result as $row){

   

?>



<div class="card">
    <div class="card-header">
        Edit Complaint
    </div>
    <div class="card-body">
        <form action="" method="POST">

        <label> Complainant Name: <?php echo $row['firstname'];?> <?php echo $row['lastname'];?></label> <br>
        <label> Account Number: <?php echo $row['account_num'];?></label> <br>
        <label> Address: <?php echo $row['town_name'];?> <?php echo $row['barangay'];?>, <?php echo $row['street'];?></label>
            <input type="hidden" class="form-control" id="complain_id" name="complain_id" value="<?= $row ['complain_id']; ?>">
            <div class="form-group">
                <label for="landmark" class="text-black">Landmark:</label>
                <input type="text" class="form-control" id="landmark" name="landmark" value="<?= $row['landmark']; ?>">
            </div>
            <div class="form-group">
                <label for="complaint_desc" class="text-black">Complaint Details:</label>
                <textarea type="text" class="form-control" id="complaint_desc" name="complaint_desc"><?= $row['complaint_desc']; ?></textarea>
            </div>
            <div class="button-success">
                <button type="submit" name="editcomplainbtn" class="btn btn-light">Submit</button>
                <a type="submit"  class="btn btn-light" href="complain.php">Back</a>
            </div>

            
        </form>
    </div>
</div>
<?php
include 'src/init.php';

if (isset($_POST['editcomplainbtn'])) {
    $complainID = $strip->strip($_POST['complain_id']);
    $complainlm = $strip->strip($_POST['landmark']);
    $complain_desc = $strip->strip($_POST['complaint_desc']);
    
    $sql = "UPDATE complaint_tbl SET landmark = '$complainlm', complaint_desc = '$complain_desc' WHERE complain_id = '$complainID'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo '<script> 
                swal.fire({
                    icon: "success",
                    title: "Change has been Saved!",
                    text: "Click OK to refresh the page.",
                    type: "success"
                }).then(function(){
                    window.location="complain.php";
                });
              </script>';
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<?php 
    }}}
?>

