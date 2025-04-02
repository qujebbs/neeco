<?php
    require_once __DIR__ . "/../repositories/ComplaintRepo.php";
    require_once __DIR__ . "/../filters/AccountFilters.php";

    function getData(){
        session_start();
        $positionId = $_SESSION['positionId'];
        $username = $_SESSION['username'];
        $complaintRepo = new ComplaintRepo();
        $filter = new ComplaintFilter([
            'employeeId' => $_SESSION['employeeId']
        ]);
        $complaintRepo->countByFilter($filter);
        // $notifications not included yet

        //TODO RETURN ALL THIS
    } 