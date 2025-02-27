<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Sanitizer</title>
</head>
<body>
    <h2>Award Submission Form</h2>
    <form action="playground.php" method="POST">
        
        <label for="awardId">Award Id:</label>
        <input type="text" id="AwardId" name="awardId" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>


<?php 
    require_once("src/handlers/awardHandler.php");
    require_once("utils/debugUtil.php");
    require_once("src/config/db.php");

    $con = getPDOConnection();

    deleteAward($con);

    
