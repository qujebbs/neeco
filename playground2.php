<?php
    include "utils/debugUtil.php";
    include "src/filters/ConsumerFilters.php";
    include "src/repositories/ConsumerRepo.php";

    $statuses = [
        "pending" => "1",
        "active" => "2",
        "archived" => "3"
    ];
    $status = "1";
    $filter = new ConsumerFilter([
                    "consumerId" => "10"
                ]);
    
    $consumerRepo = new ConsumerRepo();
    $accounts = $consumerRepo->selectByFilters($filter);

    dumpVar($accounts);

