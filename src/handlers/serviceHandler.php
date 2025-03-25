<?php
    require_once __DIR__ . "/../repositories/ServiceRepo.php";
    require_once __DIR__ . "/../models/ServiceModel.php";
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
                            header("Location: /neeco2/service?success=District Office created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/service?error=Failed to upload District Office.");
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

            public function deleteRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->serviceRepo->delete($_POST['servceId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$serviceHandler = new ServiceHandler($con);
$serviceHandler->handleRequest();
    
//VIEWS NOT READY