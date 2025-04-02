<?php

function getPDOConnection()
{
    $server = "JERALD\SQLEXPRESS";
    $db = "neeco2area1";
    
    try {
        $dsn = "sqlsrv:Server=$server;Database=$db";
        
        // Create a PDO instance
        $pdo = new PDO($dsn);
        
        // Set error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}


$servername = "localhost";
$username = "root";
$password = "105671080088";
$database = "neecollarea1";


date_default_timezone_set('Asia/Manila');

$con = new mysqli($servername, $username, $password,$database);


if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
