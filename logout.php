<?php
session_start();

include 'src/init.php';


if (isset($_SESSION['employeeid'])) {
    $emp_id = $_SESSION['employeeid'];

    $user_id = $_SESSION['userid']; 

    $active = "UPDATE user_tbl SET active = 0 WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $active); 
    $logQuery = "INSERT INTO logs_tbl (employee_id, log_activity) VALUES ($emp_id, 'logout')";
    mysqli_query($con, $logQuery);
}


$_SESSION = array();


session_destroy();


header('location: index.php');
exit(); 
?>