<?php
    require_once __DIR__ . "/../repositories/ServiceRepo.php";
    require_once __DIR__ . "/../models/ServiceModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    class ServiceHandler {
        private $serviceRepo;
    
        public function __construct($con) {
            $this->serviceRepo = new ServiceRepo();
        }

        public function handleRequest() {
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

                    $this->serviceRepo->update($service, $_POST['rateId']);
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteService(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if($this->serviceRepo->delete($_POST['serviceId'])){
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