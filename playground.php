<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV File</title>
</head>
<body>
    <h2>Upload CSV File</h2>
    <form action="playground.php" method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>


<?php 
include "database/bills.db.php";

$con = getPDOConnection();
if ($con) {
    echo "Connected successfully!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv_file"])) {
    $fileTmpPath = $_FILES["csv_file"]["tmp_name"];

    if (file_exists($fileTmpPath)) {
        insertBills($fileTmpPath, $con);
    } else {
        echo "File upload failed!";
    }
}