<?php
    require_once __DIR__ . "/../repositories/RateRepo.php";
    require_once __DIR__ . "/../models/RateModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    class RateHandler {
        private $rateRepo;
    
        public function __construct($con) {
            $this->rateRepo = new RateRepo();
        }

        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createRate',
                'update' => 'updateRate',
                'delete' => 'deleteRate',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
            public function getAll(){
                $rates = $this->rateRepo->selectAll(); 

                include __DIR__ . "/../../public/views/rate.php";
            }

            public function createRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
                        $rate = new Rate($_POST);
                        try{ 
                            $fileHandler = new FileHandler('uploads/');
                            $allowedTypes = ['application/pdf'];
                            $rate->pdf = $fileHandler->uploadFile($_FILES['pdf'], $allowedTypes);
                            if ($this->rateRepo->insert($rate)){
                                header("Location: /neeco2/rate?success=Staff created successfully");
                                exit;
                            }else{
                                header("Location: /neeco2/rate?error=Failed to upload staff picture.");
                                exit();
                            };
                        }catch (FileUploadException $e) {
                            header("Location: /neeco2/rate?error=" . urlencode($e->getMessage()));
                            exit;
                        }
                    }
                }
            }

            public function updateRate() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $rate = new Rate($_POST);

                    $this->rateRepo->update($rate, $_POST['rateId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->rateRepo->delete($_POST['rateId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$rateHandler = new RateHandler($con);
$rateHandler->handleRequest();
    
//VIEWS NOT READY