<?php
    require_once("src/repositories/ServiceRepo.php");
    require_once("src/models/ServiceModel.php");
    class ServiceHandler {
        private $serviceRepo;
    
        public function __construct($con) {
            $this->serviceRepo = new ServiceRepo($con);
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
            $towns = $this->serviceRepo->selectAll(); 

            include "views/unimplemented";
        }

            public function createService(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $service = new Service($_POST);

                    $this->serviceRepo->insert($service);
            
                    header("Location: views/unimplemented.php");
                    exit;
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