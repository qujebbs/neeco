<?php
    require_once __DIR__ . "/../repositories/ComplaintRepo.php";
    require_once __DIR__ . "/../filters/AccountFilters.php";

    function getData(){
        session_start();
        $complaintRepo = new ComplaintRepo();
        $filter = new ComplaintFilter([
            'employeeId' => $_SESSION['employeeId']
        ]);
        
        $complaints = $complaintRepo->selectByFilter($filter);
        $positionId = $_SESSION['positionId'];
        $username = $_SESSION['username'];
        $complaintCount = count($complaints);

        return [
            'complaints' => $complaints,
            'positionId' => $positionId,
            'username' => $username,
            'complaintCount' => $complaintCount
        ];
    } 