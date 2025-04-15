<?php
// TODO:THIS REQUIRES IS ALSO USED IN SIDEBAR FIX LATER
    require_once __DIR__ . "/../repositories/AccountRepo.php";
    require_once __DIR__ . "/../repositories/ComplaintRepo.php";
    require_once __DIR__ . "/../filters/AccountFilters.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    
    class DashboardHandler{
        private $accountRepo;
        private $complaintRepo;

        public function __construct() {
            $this->accountRepo = new AccountRepo();
            $this->complaintRepo = new ComplaintRepo();            
        }

        public function load() {
            //Check user access
            $currentUser = Auth::requirePosition([
                'admin', 'finance', 'tsd', 'hr', 'ogm', 'dcso', 'lineman', 'citet', 'audit'
            ]);
        
            //ACCOUNT STATUS COUNTS
            $accountFilter = new AccountFilter([
                'groupBy' => 'a.accountStatusId'
            ]);
            $accounts = $this->accountRepo->countByFilter($accountFilter);
        
            $accountstatusCounts = [];
            foreach ($accounts as $row) {
                $accountstatusId = (int) $row['acs'];
                $accountstatusCounts[$accountstatusId] = (int) $row['count'];
            }
        
            $pendingRequests = $accountstatusCounts[1] ?? 0;
            $archivedUser    = $accountstatusCounts[3] ?? 0;
        
            //COMPLAINT STATUS COUNTS
            $complaintFilter = new ComplaintFilter([
                'groupBy' => 'c.statusId'
            ]);
            $complaints = $this->complaintRepo->countByFilter($complaintFilter);
        
            $complaintstatusCounts = [];
            foreach ($complaints as $row) {
                $complaintstatusId = (int) $row['cs'] ?? null;
                $complaintstatusCounts[$complaintstatusId] = (int) $row['count'] ?? null;
            }
        
            $pendingComplaints   = $complaintstatusCounts[1] ?? 0;
            $forwardedComplaint  = $complaintstatusCounts[2] ?? 0;
            $solvedComplaints    = $complaintstatusCounts[3] ?? 0;
        
            //COMPLAINTS BY MONTH (for Chart.js)
            $complaintCountByMonth = $this->complaintRepo->getComplaintByMonth();
            $months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
            $complaintCounts = array_fill_keys($months, 0);
        
            foreach ($complaintCountByMonth as $row) {
                $complaintCounts[$row['ComplaintMonth']] = (int) $row['TotalComplaints'];
            }
        
            $solvedComplaintsData = [
                "labels" => array_keys($complaintCounts),
                "data"   => array_values($complaintCounts)
            ];
        
            //COMPLAINTS BY TOWN (for Chart.js)
            $complaintsCountByTown = $this->complaintRepo->getComplaintCountByTown();
            $towns = ["TALAVERA", "MUNOZ", "TALUGTUG", "STO.DOMINGO", "LUPAO", "GUIMBA", "QUEZON", "CARRANGLAN", "ALIAGA", "LICAB"];
            $townCounts = array_fill_keys($towns, 0);
        
            foreach ($complaintsCountByTown as $row) {
                $townCounts[$row['TownName']] = (int) $row['Total'];
            }
        
            $complaintsByTownData = [
                "labels" => array_keys($townCounts),
                "data"   => array_values($townCounts),
                "colors" => ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#fd7e14', '#20c997', '#6f42c1', '#17a2b8']
            ];
        
            //USER COUNTS
            $totalUser  = $this->accountRepo->countAll();
            $activeUser = 1; // TODO:
        
            //COMPLAINT COUNTS
            $complaintsCount = $this->complaintRepo->countAll();
        
            //Load dashboard view
            include __DIR__ . "/../../public/views/dashboard.php";
        }        
    }

    $dashboard = new DashboardHandler();
    $dashboard->load();