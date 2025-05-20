<?php

function getPDOConnection()
{
    $server =  $_ENV['DB_SERVER'];
    $db =  $_ENV['DB_NAME'];
    $user =  $_ENV['DB_USER'];
    $pass =  $_ENV['DB_PASS'];

    try {
        $dsn = "sqlsrv:Server=$server;Database=$db";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    }
?>
