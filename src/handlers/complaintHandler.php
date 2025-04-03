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
                $filter = new ComplaintFilter([
                ]);
                $complaints = $this->complaintRepo->selectByFilter($filter);
                $employeeRepo = new EmployeeRepo();
                $tempemployees = $employeeRepo->getEmployeesByTown($_SESSION['townId']);
                $employees = array_column($tempemployees, 'firstname',  'employeeId');

                $tempcomplaintNature = $this->complaintRepo->getComplaintNatures();
                $natures = array_column($tempcomplaintNature, 'complaintReason', 'natureId');


                include __DIR__ . "/../../public/views/dumper.php";
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