<?php
    require_once __DIR__ . "/../models/EmployeeModel.php";
    require_once __DIR__ . "/../repositories/EmployeeRepo.php";
    require_once __DIR__ . "/../repositories/AccountRepo.php";
    require_once __DIR__ . "/../models/AccountModel.php";
    require_once __DIR__ . "/../logs/logger.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";

    class EmployeeHandler{
        private $employeeRepo;
        private $accountRepo;
        public $logger;

        public function __construct() {
            $this->employeeRepo = new EmployeeRepo();
            $this->logger = new Logger();
            $this->accountRepo = new AccountRepo();
        }

        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createEmployee',
                'update' => 'updateEmployee',
                'delete' => 'deleteEmployee',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }

        public function getAll(){
            $employees = $this->employeeRepo->selectAll();

            $temppositions = $this->employeeRepo->getPositions();
            $positions = array_column($temppositions,'positionName', 'positionId');

            $temptowns = $this->employeeRepo->getTowns();
            $towns = array_column($temptowns,'townDesc', 'townID');

            $tempGender = [
                ['gender' => 1, 'genderName' => 'male'],
                ['gender' => 2, 'genderName' => 'female']
            ];
            $gender = array_column($tempGender, 'genderName', 'gender');


            include __DIR__ . "/../../public/views/employees.php";
        }

        public function createEmployee() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $employee = new Employees($_POST);
                $account = new Account($_POST);

                $this->logger->log($_SESSION['employeeId'], "Added New Employee");

                if($this->employeeRepo->insert($employee) && $this->accountRepo->insert($account)){
                    header("Location: /neeco2/employee?success=Employee created successfully");
                    exit;
                }else{
                    header("Location: /neeco2/employee?error=Failed to upload Employee.");
                    exit();
                };
            }
        }

        public function updateEmployee() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $employee = new Employees($_POST);
                $this->logger->log($_SESSION['employeeId'], "Updated an Employee");
                if($this->employeeRepo->update($employee, $_POST['employeeId'])){
                    header("Location: /neeco2/employee?success=Employee updated successfully");
                    exit;
                }else{
                    header("Location: /neeco2/employee?error=Failed to update Employee.");
                    exit();
                };
            }
        }
        public function deleteEmployee() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employeeId'])) {
                $this->logger->log($_SESSION['employeeId'], "Deleted an Employee");
                if($this->employeeRepo->delete($_POST['employeeId'])){
                    header("Location: /neeco2/employee?success=Employee deleted successfully");
                    exit;
                }else{
                    header("Location: /neeco2/employee?error=Failed to delete Employee.");
                    exit();
                };
            }
        }
    }

$employeeHandler = new EmployeeHandler();
$employeeHandler->handleRequest();
