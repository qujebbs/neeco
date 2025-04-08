<?php
    require_once __DIR__ . "/../repositories/ComplaintRepo.php";
    require_once __DIR__ . "/../models/ComplaintModel.php";
    require_once __DIR__ . "/../filters/ComplaintFilters.php";
    require_once __DIR__ . "/../repositories/EmployeeRepo.php";
    require_once __DIR__ . "/../../src/helpers/complaintHelper.php";
    class ComplaintHandler {
        private $complaintRepo;
    
        public function __construct($con) {
            $this->complaintRepo = new ComplaintRepo();
        }

            public function handleRequest() {
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createComplaint',
                    'update' => 'updateComplaint',
                    'delete' => 'deleteComplaint',
                    'getAll' => 'getAll'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }

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

                if (isset($_SESSION['employeeId']) || $_SESSION['consumerId'] == 0) {
                    $filter = new ComplaintFilter([
                        "employeeId"=> $_SESSION['employeeId'],
                        "statusId"=> $statuses[$status] ?? null
                    ]);
                }elseif(isset($_SESSION['consumerId']) || $_SESSION['employeeId'] == 0) {
                    $filter = new ComplaintFilter([
                        "employeeId"=> $_SESSION['consumerId'],
                        "statusId"=> $statuses[$status] ?? null
                    ]);
                }else{
                    $filter = new ComplaintFilter([
                        "statusId"=> $statuses[$status] ?? null
                    ]);
                }

                $complaints = $this->complaintRepo->selectByFilter($filter);
                $employeeRepo = new EmployeeRepo();
                $tempemployees = $employeeRepo->getEmployeesByTown($_SESSION['townId']);
                $employees = array_column($tempemployees, 'firstname',  'employeeId');

                $tempcomplaintNature = $this->complaintRepo->getComplaintNatures();
                $natures = array_column($tempcomplaintNature, 'complaintReason', 'natureId');

                include __DIR__ . "/../../public/views/complaints.php";
            }

            //* @param int $accountId The complainant.
            //* @param int $employeeId The current employee the complaint is assigned to.
            public function createComplaint(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $complaint = new Complaint($_POST);

                    $this->complaintRepo->insert($complaint);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }
            public function updateComplaint() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $complaint = new Complaint($_POST);

                    $this->complaintRepo->update($complaint, $_POST);
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteComplaint(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->complaintRepo->delete($_POST["id"]);
                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$complaintHandler = new ComplaintHandler($con);
$complaintHandler->handleRequest();


//VIEWS NOT READY