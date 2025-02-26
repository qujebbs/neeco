<?php

    include("src/config/db.php");
    include("src/repositories/BillRepo.php");
    include("src/utils/csvHandler.php");
    include("utils/debugUtil.php");

    $con = getPDOConnection();


    $csvFile = "C:/xampp/htdocs/neeco2/testFiles/testBills.csv";

    $bills = readBillsCSV($csvFile);

    $bill = new BillRepo($con);
    $bill->insert($bills);

    include ("awards.php");
