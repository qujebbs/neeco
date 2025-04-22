<?php
    require_once __DIR__ . "/../repositories/BodRepo.php";
    require_once __DIR__ . "/../models/BodModel.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    class BodHandler {
        private $bodRepo;
        public $logger;
    
        public function __construct($con) {
            $this->bodRepo = new BodRepo();
            $this->logger = new Logger();
        }

        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createBod',
                'update' => 'updateBod',
                'delete' => 'deleteBod',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }

            public function getAll(){
                $bods = $this->bodRepo->selectAll(); 

                include __DIR__ . "/../../public/views/bod.php";
            }

            public function createBod(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bodPicture'])) {
                    $bod = new Bod($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        $bod->bodPicture = $fileHandler->uploadFile($_FILES['bodPicture'], $allowedTypes);
                        if ($this->bodRepo->insert($bod)){
                            $this->logger->log($_SESSION['employeeId'], "Created New Bod {$bod->bodName}");
                            header("Location: /neeco2/bod?success=BOD created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/bod?error=Failed to upload BOD.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/bod?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function updateBod() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $bod = new Bod($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        $bod->bodPicture = $fileHandler->uploadFile($_FILES['bodPicture'], $allowedTypes);
                        if ($this->bodRepo->update($bod, $_POST['bodId'])){
                            $this->logger->log($_SESSION['employeeId'], "Updated A Bod");
                            header("Location: /neeco2/bod?success=BOD Updated successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/bod?error=Failed to update BOD.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/bod?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function deleteBod(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if($this->bodRepo->delete($_POST['bodId'])){
                        $this->logger->log($_SESSION['employeeId'], "Deleted A Bod");
                        header("Location: /neeco2/bod?success=BOD deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/bod?error=Failed to delete BOD.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$bodHandler = new BodHandler($con);
$bodHandler->handleRequest();
    

//VIEWS NOT READY