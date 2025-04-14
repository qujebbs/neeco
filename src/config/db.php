<?php

function getPDOConnection()
{
    // $server = "localhost\\SQLEXPRESS";
    // $db = "neeco2area1";
    
    // try {
    //     $dsn = "sqlsrv:Server=$server;Database=$db";
        
    //     // Create a PDO instance
    //     $pdo = new PDO($dsn);
        
    //     // Set error mode to exception
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    //     return $pdo;
    // } catch (PDOException $e) {
    //     die("Connection failed: " . $e->getMessage());
    // }
    $server = "127.0.0.1,1433"; // Named instance
    // $server = "127.0.0.1,1433";    // IP + port
    $db = "neeco2area1";
    $user = "sa";
    $pass = "Cathpalug2256";

    try {
        $dsn = "sqlsrv:Server=$server;Database=$db";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    }



    $servername = "localhost";
    $username = "root";
    $password = "Cathpalug2256";
    $database = "neecollarea1";

    date_default_timezone_set('Asia/Manila');

    $con = new mysqli($servername, $username, $password,$database);


    if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

?>
