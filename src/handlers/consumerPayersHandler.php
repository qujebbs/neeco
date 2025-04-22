<?php
    require_once __DIR__ . "/../repositories/ConsumerPayersRepo.php";
    require_once __DIR__ . "/../models/ConsumerPayersModel.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    class ConsumerPayersHandler {
        private $consumerPayersRepo;
        public $logger;
    
        public function __construct($con) {
            $this->consumerPayersRepo = new ConsumerPayersRepo();
            $this->logger = new Logger();
        }

            public function handleRequest() {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $currentUser = Auth::requirePosition(['admin']);
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createConsumerPayers',
                    'update' => 'updateConsumerPayers',
                    'delete' => 'deleteConsumerPayers',
                    'getAll' => 'getAll'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }

            public function getAll(){
                $consumerPayers = $this->consumerPayersRepo->selectAll(); 

                include __DIR__ . "/../../public/views/consumerPayers.php";
            }

            public function createConsumerPayers(){
                $this->logger->log($_SESSION['employeeId'], "Created New Consumer Payer");
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $consumerPayer = new ConsumerPayers($_POST);

                    $this->consumerPayersRepo->insert($consumerPayer);

                    header("Location: /neeco2/consumer-payer");
                    exit;
                }
            }

            public function updateConsumerPayers() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $consumerPayer = new ConsumerPayers($_POST);


                if ($this->consumerPayersRepo->update($consumerPayer, $_POST['payerId'])){
                    $this->logger->log($_SESSION['employeeId'], "Updated A Consumer Payer");
                    header("Location: /neeco2/consumer-payer?success=Consumer Payer updated successfully");
                    exit;
                }else{
                    header("Location: /neeco2/consumer-payer?error=Failed to Update Consumer Payer.");
                    exit();
                }
                }
            }

            public function deleteConsumerPayers(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if($this->consumerPayersRepo->delete($_POST['payerId'])){
                        $this->logger->log($_SESSION['employeeId'], "Deleted A Consumer Payer");
                        header("Location: /neeco2/consumer-payer?success=Consumer Payer deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/consumer-payer?error=Failed to delete Consumer Payer.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$consumerPayersHandler = new ConsumerPayersHandler($con);
$consumerPayersHandler->handleRequest();
    
//VIEWS NOT READY