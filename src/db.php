<?php
$servername = "localhost";
$username = "root";
$password = "105671080088";
$database = "neecollarea1";


date_default_timezone_set('Asia/Manila');

$con = new mysqli($servername, $username, $password,$database);


if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
error_reporting(0);

// $serverName = "localhost";
// $connectionOptions = [
//     "Database" => "neeco2area1", 
//     "TrustServerCertificate" => true 
// ];


// $conn = sqlsrv_connect($serverName, $connectionOptions);

// if ($conn === false) {
//     die(print_r(sqlsrv_errors(), true));
// } else {
//     echo "Connection successful! <br>";
// }
?>
