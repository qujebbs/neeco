<?php
    require_once __DIR__ . "/../repositories/DistrictOfficesRepo.php";
    require_once __DIR__ . "/../models/DistrictOfficesModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";

    class DistrictOfficesHandler {
        private $districtOfficesRepo;
        public $logger;
    
        public function __construct($con) {
            $this->districtOfficesRepo = new DistrictOfficesRepo();
            $this->logger = new Logger();
        }
        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createDistrictOffices',
                'update' => 'updateDistrictOffices',
                'delete' => 'deleteDistrictOffices',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
            public function getAll(){
                $districtOffices = $this->districtOfficesRepo->selectAll(); 

                include __DIR__ . "/../../public/views/districtOffices.php";
            }

            public function createDistrictOffices(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['districtPic'])) {
                    $districtOffice = new DistrictOffices($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                        $districtOffice->districtPic = $fileHandler->uploadFile($_FILES['districtPic'], $allowedTypes);
                        if ($this->districtOfficesRepo->insert($districtOffice)){
                            $this->logger->log($_SESSION['employeeId'], "Created New District Office");
                            header("Location: /neeco2/district-office?success=District Office created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/district-office?error=Failed to upload District Office.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/district-office?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }            
            }

            public function updateDistrictOffices() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $districtOffice = new DistrictOffices($_POST);

                    $tempDistrictOffice = new DistrictOffices($this->districtOfficesRepo->selectOne($_POST['districtId']));
            
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                        if (!empty($_FILES['districtPic']['name'])){
                            $districtOffice->districtPic = $fileHandler->uploadFile($_FILES['districtPic'], $allowedTypes);
                        }else{
                            $districtOffice->districtPic = $tempDistrictOffice->districtPic;
                        }
                        if ($this->districtOfficesRepo->update($districtOffice, $_POST['districtId'])){
                            $this->logger->log($_SESSION['employeeId'], "Updated A District Office");
                            header("Location: /neeco2/district-office?success=District Office updated successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/district-office?error=Failed to update District Office.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/district-office?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function deleteDistrictOffices(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if($this->districtOfficesRepo->delete($_POST['districtId'])){
                        $this->logger->log($_SESSION['employeeId'], "Deleted A District Office");
                        header("Location: /neeco2/district-office?success=District Office deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/district-office?error=Failed to delete District Offie.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$districtOfficesHandler = new DistrictOfficesHandler($con);
$districtOfficesHandler->handleRequest();
    

//VIEWS NOT READY