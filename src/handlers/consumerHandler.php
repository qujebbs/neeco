<?php
    require_once __DIR__ . "/../repositories/ConsumerRepo.php";
    require_once __DIR__ ."/../repositories/AccountRepo.php";
    require_once __DIR__ . "/../models/ConsumerModel.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    require_once __DIR__ . "/../utils/csvHandler.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    class ConsumerHandler {
        private $consumerRepo;
        public $logger;
        public $accountRepo;
    
        public function __construct() {
            $this->consumerRepo = new ConsumerRepo();
            $this->logger = new Logger();
            $this->accountRepo = new AccountRepo();
        }
        public function handleRequest() {
            $currentUser = Auth::requirePosition(['admin']);
            $action = $_REQUEST['action'] ?? 'getConsumers';
        
            $actions = [
                'create' => 'createConsumer',
                'update' => 'updateConsumer',
                'delete' => 'deleteConsumer',
                'getConsumers' => 'getConsumers'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
            public function createConsumer(){
                $currentUser = Auth::requirePosition(['admin']);
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['consumerCsv'])) {
                    $file = $_FILES['consumerCsv'];
                
                    if ($file['error'] !== UPLOAD_ERR_OK) {
                        header("Location: /neeco2/consumer?error=File upload failed.");
                        exit;
                    }
                
                    try {
                        $consumersArr = readConsumerCsv($file["tmp_name"]);
                
                        if (empty($consumersArr)) {
                            header("Location: /neeco2/consumer?error=No valid consumer records found in the file.");
                            exit;
                        }
                
                        if ($this->consumerRepo->insert($consumersArr)) {
                            $this->logger->log($_SESSION['employeeId'], "Created Consumers via CSV upload");
                            dumpVar($consumersArr);
                            header("Location: /neeco2/consumer?success=Consumers created successfully");
                            exit;
                        } else {
                            header("Location: /neeco2/consumer?error=Failed to create consumer records.");
                            exit;
                        }
                
                    } catch (Exception $e) {
                        $msg = urlencode("CSV Error: Invalid Format");
                        header("Location: /neeco2/consumer?error=$msg");
                        exit;
                    }
                } else {
                    header("Location: /neeco2/consumer?error=No file uploaded.");
                    exit;
                }
                
            }

            public function updateConsumer() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($this->accountRepo->updateStatus($_POST['accountStatusId'], $_POST['accountId'])){
                        $this->logger->log($_SESSION['employeeId'], "Updated A Account Status");
                        header("Location: /neeco2/consumer?success=Consumer Account successfully Updated");
                        exit;
                    }else{
                        header("Location: /neeco2/consumer?error=Failed to update Consumer Account.");
                        exit();
                    };
                }
            }

            public function deleteConsumer(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $result = $this->accountRepo->delete($_POST['accountId']);
                    if($result > 0){
                        $this->logger->log($_SESSION['employeeId'], "Deleted an Account");
                        header("Location: /neeco2/consumer?success=Consumer deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/consumer?error=Failed to delete Consumer.");
                        exit();
                    };
            }
            }
            public function getConsumers() {
                    $statuses = [
                        "pending" => 1,
                        "verified" => 2,
                        "archived" => 3
                    ];

                    $statusDropdown = [
                        1 => 'Pending',
                        2 => 'Active',
                        3 => 'Archived'
                    ];
                
                    $status = $_GET['status'] ?? null;
                
                    if (isset($status) && !isset($statuses[$status])) {
                        http_response_code(400);
                        echo "Invalid Request.";
                        exit;
                    }
                
                    $filter = new ConsumerFilter([
                        "accountStatusId" => $statuses[$status] ?? null
                    ]);
                
                    $totalCount = $this->consumerRepo->countByFilters($filter);
                    $limit = 1000;
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) && ctype_digit($_GET['page']) && intval($_GET['page']) > 0
                        ? intval($_GET['page'])
                        : 1;
                    
                    $totalPages = ceil($totalCount / $limit);
                    if ($page < 1 || $page > $totalPages) {
                        echo "Invalid Requestss";
                    }
                    $accounts = $this->consumerRepo->selectByFilters($filter, $limit, ($page - 1) * $limit);
                
                    include __DIR__ . "/../../public/views/consumers.php";
            }
            
            
            
            // public function getConsumers() {
            //     if (isset($_GET["status"])){
            //         $statuses = [
            //             "pending" => 1,
            //             "verified" => 2,
            //             "archived" => 3
            //         ];
            
            //         $status = $_GET['status'] ?? null;

            //         if (!isset($statuses[$status])) {
            //             http_response_code(400);
            //             echo "Invalid status.";
            //             exit;
            //         }
            
            //         $filter = new ConsumerFilter([
            //             "accountStatusId" => $statuses[$status]
            //         ]);
            
            //         $accounts = $this->consumerRepo->selectByFilters($filter);

            //         include "views/accounts.php";
            // }else{
            //     $towns = $this->consumerRepo->selectAll(); 

            //     include "views/unimplemented";
            // }
            // }
            
    }

$con = getPDOConnection();
$consumerHandler = new ConsumerHandler();
$consumerHandler->handleRequest();


//VIEWS NOT READY