<?php
    require_once __DIR__ . "/../repositories/ComplaintRepo.php";
    require_once __DIR__ . "/../models/ComplaintModel.php";
    require_once __DIR__ . "/../filters/ComplaintFilters.php";
    require_once __DIR__ . "/../repositories/EmployeeRepo.php";
    require_once __DIR__ . "/../../src/helpers/complaintHelper.php";
    require_once __DIR__ . "/../utils/validateComplaints.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    class ComplaintHandler {
        private $complaintRepo;
        private $employeeRepo;
    
        public function __construct($con) {
            $this->complaintRepo = new ComplaintRepo();
            $this->employeeRepo = new EmployeeRepo();
        }
        
            public function handleRequest() {
                $currentUser = Auth::requireAuth();
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createComplaint',
                    'update' => 'updateComplaint',
                    'delete' => 'deleteComplaint',
                    'getAll' => 'getAll',
                    'mark' => 'markAsSolved'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }

            //TODO: own complaints should be displayed
            //TODO: assignment choices should be dcso->employees not dcso->dcso&&employees
            //TODO: complaints displayed should only be the complaints on the users town
            public function getAll(){
                session_start();
                $statuses = [
                    "received" => 1,
                    "unattended" => 2,
                    "solved" => 3
                ];
                $status = $_GET['status'] ?? null;
                
                if (isset($status) && !isset($statuses[$status])) {
                    http_response_code(400);
                    echo "Invalid Request.";
                    exit;
                }

                if (!isset($status)) {
                        $filter = new ComplaintFilter([
                            "accountId"=> $_SESSION['accountId'],
                        ]);
                } else {
                    if ((isset($_SESSION['employeeId']) || $_SESSION['consumerId'] == 0) && $_SESSION['positionId'] != 7 ){
                        $filter = new ComplaintFilter([
                            "employeeId"=> $_SESSION['employeeId'],
                            "statusId"=> $statuses[$status] ?? null
                        ]);
                    }elseif(isset($_SESSION['consumerId']) || $_SESSION['employeeId'] == 0) {
                        $filter = new ComplaintFilter([
                            "accountId"=> $_SESSION['accountId'],
                            "statusId"=> $statuses[$status] ?? null
                        ]);
                    }else{
                        $filter = new ComplaintFilter([
                            "townId" => $_SESSION["townId"],
                            "statusId"=> $statuses[$status] ?? null
                        ]);
                    }
                }

                $complaints = $this->complaintRepo->selectByFilter($filter);
                $tempemployees = $this->employeeRepo->getEmployeesByTown($_SESSION['townId']);
                $employees = array_column($tempemployees, 'firstname',  'employeeId');

                $tempcomplaintNature = $this->complaintRepo->getComplaintNatures();
                $natures = array_column($tempcomplaintNature, 'complaintReason', 'natureId');

                $statuses = [
                    1 => 'Pending',
                    2 => 'Assigned',
                    3 => 'Resolved'
                ];
                

                include __DIR__ . "/../../public/views/complaints.php";
            }

            //* @param int $accountId The complainant.
            //* @param int $employeeId The current employee the complaint is assigned to.
            public function createComplaint(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    session_start();
                    $complaint = new Complaint($_POST);
                    $dcso = $this->employeeRepo->getTownDcso($_SESSION['townId']);
                    $complaint->employeeId = $dcso['employeeId'];
                    $complaint->statusId = 1;
                    $complaint->accountId = $_SESSION['accountId'];
                    $complaint->townId = $_SESSION['townId'];
                    
                    $validation = validateComplaint($complaint);

                    if (!$validation['valid']) {
                        http_response_code(400);
                        echo json_encode(['errors' => $validation['errors']]);
                        exit;
                    }

                    if($this->complaintRepo->insert($complaint)){
                        header("Location: /neeco2/complaint?success=Complaint posted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/complaint?error=Failed to create Complaint.");
                        exit;
                    };
                }
            }
            public function updateComplaint() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    session_start();

                    $currentUserPositionId = (int) $_SESSION['positionId'];
                    
                    $complaint = new Complaint($_POST);
                    $filter = new ComplaintFilter([
                        "complaintId"=> (int) $_POST['complaintId']
                    ]);

                    $existingComplaint = $this->complaintRepo->selectByFilter($filter);
                    
                    if (!$existingComplaint) {
                        header("Location: /neeco2/complaint?error=Complaint not found.");
                        exit;
                    }
                    
                    //employeeId change check
                    $isAssigning = isset($complaint->employeeId) && $complaint->employeeId != $existingComplaint[0]['employeeId'];
                    
                    if ($isAssigning) {
                        if ($currentUserPositionId === 2 || $currentUserPositionId === 7) {
                            $assignedEmployeeData = $this->employeeRepo->getEmployeesById($complaint->employeeId);
                    
                            if (!empty($assignedEmployeeData)) {
                                $assignedEmployee = new Employees($assignedEmployeeData[0]);
                                $assignedEmployeePositionId = (int) $assignedEmployee->positionId;
                    
                                $lowerRoles = [3, 4, 5, 6, 8, 9];
                    
                                if (in_array($assignedEmployeePositionId, $lowerRoles)) {
                                    $complaint->statusId = 2; //default to assigned
                                }
                            } else {
                                header("Location: /neeco2/complaint?error=Assigned employee not found.");
                                exit;
                            }
                        } else {
                            header("Location: /neeco2/complaint?error=You are not allowed to assign complaints.");
                            exit;
                        }
                    }
                    
                    //set previous values on nulls
                    if (!isset($complaint->statusId)) {
                        $complaint->statusId = $existingComplaint[0]['statusId'];
                    }
                    if (!isset($complaint->employeeId)) {
                        $complaint->employeeId = $existingComplaint[0]['employeeId'];
                    }
                    if (!isset($complaint->complaintDesc)) {
                        $complaint->complaintDesc = $existingComplaint[0]['complaintDesc'];
                    }
                    
                    //Validation
                    $validation = validateComplaint($complaint);
                    if (!$validation['valid']) {
                        //url encode to not destroy url
                        $encodedErrors = urlencode(implode(', ', $validation['errors']));
                        header("Location: /neeco2/complaint?error={$encodedErrors}");
                        exit;
                    }
                    
                    // update
                    if ($this->complaintRepo->update($complaint, $_POST['complaintId'])) {
                        header("Location: /neeco2/complaint?success=Complaint updated successfully");
                        exit;
                    } else {
                        header("Location: /neeco2/complaint?error=Failed to update complaint.");
                        exit;
                    }
                    
                }
            }

            public function markAsSolved(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $action = new ComplaintAction($_POST);

                    $error = '';
                    $result = $this->complaintRepo->markAsSolved($action, $error);

                    if ($result) {
                        header("Location: /neeco2/complaint?success=Complaint updated successfully");
                        exit;
                    }else {
                        header("Location: /neeco2/complaint?error=". urlencode("Failed: $error"));
                        exit;
                    }
                }
            }

            public function deleteComplaint(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if($this->complaintRepo->delete($_POST['complaintId'])){
                        header("Location: /neeco2/complaint?success=complaint deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/complaint?error=Failed to delete complaint.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$complaintHandler = new ComplaintHandler($con);
$complaintHandler->handleRequest();


//VIEWS NOT READY