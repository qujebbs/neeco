<?php
    include "database/rate.db.php";
    include "utils.php";
    include "models/rate.model.php";

    //no logs yet
    function addRate($con){
        $uploadDirectory = 'assets/img/pdfrates/';
        $news_picture = $_FILES['pdf'];
        if ($news_picture['error'] === UPLOAD_ERR_OK) {
            $newspixFilename = uniqid() . '_' . basename($news_picture['name']);
            $newFilepath = $uploadDirectory . $newspixFilename;
            $rate = new Rate($newFilepath, $_POST['curdate'],$_POST['rate_type']);
            if (move_uploaded_file($news_picture['tmp_name'], $newFilepath)) {
                $isInserted = insertRate($con, $rate);
                if($isInserted){
                    die();
                }
            }
        }
    }
    
    function getRates($con){
        $rows = selectRates($con);
        $rates = [];

        foreach($rows as $row){
            $rates[] = new Rate($row['pdf'], $row['date'], $row['rateType']);
        }
        return $rates;
    }
    