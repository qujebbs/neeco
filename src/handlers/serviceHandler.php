<?php
    require_once __DIR__ . "/../repositories/ServiceRepo.php";
    require_once __DIR__ . "/../models/ServiceModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    class ServiceHandler {
        private $serviceRepo;
        public $logger;
    
        public function __construct($con) {
            $this->serviceRepo = new ServiceRepo();
            $this->logger = new Logger();
        }

        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createService',
                'update' => 'updateService',
                'delete' => 'deleteService',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }

        public function getAll(){
            $services = $this->serviceRepo->selectAll(); 

            include __DIR__ . "/../../public/views/service.php";
        }

            public function createService(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['servicePic'])) {
                    $service = new Service($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                        $service->servicePic = $fileHandler->uploadFile($_FILES['servicePic'], $allowedTypes);
                        if ($this->serviceRepo->insert($service)){
                            $this->logger->log($_SESSION['employeeId'], "Created New Service");
                            header("Location: /neeco2/service?success=Service created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/service?error=Failed to upload Service.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/service?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                } 
            }

            public function updateService() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $service = new Service($_POST);
                    $tempService = new Service($this->serviceRepo->selectOne($_POST['serviceId']));
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                        if (!empty($_FILES['servicePic']['name'])){
                            $service->servicePic = $fileHandler->uploadFile($_FILES['servicePic'], $allowedTypes);
                        }else{
                            $service->servicePic = $tempService->servicePic;
                        }
                        
                        if ($this->serviceRepo->update($service, $_POST['serviceId'])){
                            $this->logger->log($_SESSION['employeeId'], "Updated A Service");
                            header("Location: /neeco2/service?success=Service updated successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/service?error=Failed to update Service.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/service?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function deleteService(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if($this->serviceRepo->delete($_POST['serviceId'])){
                        $this->logger->log($_SESSION['employeeId'], "Deleted A Service");
                        header("Location: /neeco2/service?success=Service deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/service?error=Failed to delete Service.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$serviceHandler = new ServiceHandler($con);
$serviceHandler->handleRequest();
    
//VIEWS NOT READY