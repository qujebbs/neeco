<?php
    require_once __DIR__ . "/../repositories/StaffRepo.php";
    require_once __DIR__ . "/../models/StaffModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    class StaffHandler {
        private $staffRepo;
        public $logger;
    
        public function __construct() {
            $this->staffRepo = new StaffRepo();
            $this->logger = new Logger();
        }
            public function handleRequest() {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $currentUser = Auth::requirePosition(['admin']);
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
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['staffPic'])) {
                    $staff = new Staff($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        $staff->staffPic = $fileHandler->uploadFile($_FILES['staffPic'], $allowedTypes);
                        if ($this->staffRepo->insert($staff)){
                            $this->logger->log($_SESSION['employeeId'], "Added new Staff");
                            header("Location: /neeco2/staff?success=Staff created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/staff?error=Failed to upload staff picture.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/staff?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function updateStaff() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $staff = new Staff($_POST);
                    $tempStaff = new Staff($this->staffRepo->selectOne($_POST['staffId']));
            
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                        if (!empty($_FILES['staffPic']['name'])){
                            $staff->staffPic = $fileHandler->uploadFile($_FILES['staffPic'], $allowedTypes);
                        }else{
                            $staff->staffPic = $tempStaff->staffPic;
                        }
                        if ($this->staffRepo->update($staff, intval($_POST['staffId']))){
                            $this->logger->log($_SESSION['employeeId'], "Updated Staff");
                            header("Location: /neeco2/staff?success=Staff updated successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/staff?error=Failed to update staff picture.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/staff?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function deleteStaff(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if($this->staffRepo->delete($_POST['staffId'])){
                        $this->logger->log($_SESSION['employeeId'], "Deleted A Staff staffId = {$_POST['staffId']}");
                        header("Location: /neeco2/staff?success=Staff deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/staff?error=Failed to delete Staff.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$staffHandler = new StaffHandler();
$staffHandler->handleRequest();

//VIEWS NOT READY