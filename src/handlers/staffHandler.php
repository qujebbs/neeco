<?php
    require_once __DIR__ . "/../repositories/StaffRepo.php";
    require_once __DIR__ . "/../models/StaffModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    class StaffHandler {
        private $staffRepo;
    
        public function __construct() {
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
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['staffPic'])) {
                    $staff = new Staff($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        $staff->staffPic = $fileHandler->uploadFile($_FILES['staffPic'], $allowedTypes);
                        if ($this->staffRepo->insert($staff)){
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
            
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        $staff->staffPic = $fileHandler->uploadFile($_FILES['staffPic'], $allowedTypes);
                        if ($this->staffRepo->update($staff, intval($_POST['staffId']))){
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
$staffHandler = new StaffHandler($con);
$staffHandler->handleRequest();

//VIEWS NOT READY