<?php
    require_once __DIR__ . "/../repositories/RateRepo.php";
    require_once __DIR__ . "/../models/RateModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    class RateHandler {
        private $rateRepo;
        public $logger;

        public function __construct() {
            $this->rateRepo = new RateRepo();
            $this->logger = new Logger();
        }

        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
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
                                $this->logger->log($_SESSION['employeeId'], "Created New Rate");
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
                    $tempRates = new Rate($this->rateRepo->selectOne($_POST['rateId']));

                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['application/pdf'];
                        if (!empty($_FILES['pdf']['name'])){
                            $rate->pdf = $fileHandler->uploadFile($_FILES['pdf'], $allowedTypes);
                        }else{
                            $rate->pdf = $tempRates->pdf;
                        }
                        if ($this->rateRepo->update($rate, $_POST['rateId'])){
                            $this->logger->log($_SESSION['employeeId'], "Updated A Rate");
                            header("Location: /neeco2/rate?success=Rate updated successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/rate?error=Failed to update Rate.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/rate?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function deleteRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if($this->rateRepo->delete($_POST['rateId'])){
                        $this->logger->log($_SESSION['employeeId'], "Deleted A Rate");
                        header("Location: /neeco2/rate?success=Rate deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/rate?error=Failed to delete Rate.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$rateHandler = new RateHandler($con);
$rateHandler->handleRequest();
    
//VIEWS NOT READY