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

        public function load(){
            $currentUser = Auth::requireAuth();
            $accountFilter = new AccountFilter([
                'groupBy' => 'a.accountStatusId'
            ]);

            $accounts = $this->accountRepo->countByFilter($accountFilter);
            
            $accountstatusCounts = [];

            foreach ($accounts as $row) {
                $accountstatusId = (int)$row['acs'];
                $accountstatusCounts[$accountstatusId] = (int)$row['count'];
            }

            $pendingRequests = $accountstatusCounts[1] ?? 0;
            $archivedUser = $accountstatusCounts[3] ?? 0;

            $complaintFilter = new ComplaintFilter([
                'groupBy' => 'c.statusId'
            ]);
            $complaints = $this->complaintRepo->countByFilter($complaintFilter);

            $complaintstatusCounts = [];
            foreach ($complaints as $row){
                $complaintstatusId = (int)$row['cs'] ?? null;
                $complaintstatusCounts[$complaintstatusId] = (int)$row['count'] ?? null;
            }

            $pendingComplaints = $complaintstatusCounts[1] ?? 0;
            $forwardedComplaint = $complaintstatusCounts[2] ?? 0;
            $solvedComplaints = $complaintstatusCounts[3] ?? 0;

            $complaintsCount = $this->complaintRepo->countAll();

            $totalUser = $this->accountRepo->countAll();
            
            $activeUser = 7;
            
            include __DIR__ . "/../../public/views/dashboard.php";
        }
    }

    $dashboard = new DashboardHandler();
    $dashboard->load();