<?php

    require_once __DIR__ ."/../repositories/DownloadsRepo.php";
    require_once __DIR__ ."/../repositories/RateRepo.php";

    function getDownloads(){
        $downloadsRepo = new DownloadsRepo();
        
        $downloads = $downloadsRepo->selectAll();

        return $downloads;
    }

    function getRates(){
        $rateRepo = new RateRepo();
        
        $rates = $rateRepo->selectAll();

        return $rates;
    }