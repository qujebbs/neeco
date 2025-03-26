<?php

    class DashboardHandler{
        

        public function __construct() {
            
        }

        public function load(){
            $archivedUser = 1;
            $attendedComplaints = 2;
            $forwardedComplaint = 3;
            $pendingComplaints = 4;
            $pendingRequests = 5;
            $complaintsCount = 6;
            $archivedUser = 7;
            $totalUser = 8;
            include __DIR__ . "/../../public/views/dashboard.php";
        }
    }

    $dashboard = new DashboardHandler();
    $dashboard->load();