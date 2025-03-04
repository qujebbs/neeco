<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bills CSV</title>
</head>
<body>
    <h2>Upload Bills CSV</h2>
    <form action="playground.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>



<?php 
    require_once("src/repositories/BillRepo.php");
    require_once("src/handlers/billHandler.php");
    require_once("utils/debugUtil.php");
    require_once("src/config/db.php");
    require_once("src/models/BillModel.php");
    require_once("src/utils/csvHandler.php");

    $con = getPDOConnection();

    // $handler = new BillHandler($con);
    // $handler->createBill();

    dumpVar($_SERVER);
