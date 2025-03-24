<?php
    require_once __DIR__ . "/../repositories/StaffRepo.php";
    require_once __DIR__ . "/../models/StaffModel.php";
    class StaffHandler {
        private $staffRepo;
    
        public function __construct($con) {
            $this->staffRepo = new StaffRepo();
        }
            public function handleRequest() {
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createStaff',
                    'update' => 'updateStaff',
                    'delete' => 'deleteStaff',
                    'getAll' => 'getAll'
                ];
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
                die("Invalid action: $action");
            }
            public function getAll(){
                $staffs = $this->staffRepo->selectAll(); 

                include __DIR__ . "/../../public/views/staff.php";
            }

            public function createStaff(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $staff = new Staff($_POST);

                    $this->staffRepo->insert($staff);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateStaff() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $staff = new Staff($_POST);

                    $this->staffRepo->update($staff, intval($_POST['staffId']));
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteStaff(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->staffRepo->delete($_POST['staffId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$staffHandler = new StaffHandler($con);
$staffHandler->handleRequest();

//VIEWS NOT READY