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
