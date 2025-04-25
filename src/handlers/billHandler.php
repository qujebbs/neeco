<?php
    require_once __DIR__ . "/../repositories/BillRepo.php";
    require_once __DIR__ . "/../models/BillModel.php";
    require_once __DIR__ . "/../../src/config/db.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../utils/csvHandler.php";
    require_once __DIR__ . "/../logs/logger.php";
    class BillHandler {
        private $billRepo;
        public $logger;
    
        public function __construct() {
            $this->billRepo = new BillRepo();
            $this->logger = new Logger();
        }
        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createBill',
                'update' => 'updateBill',
                'delete' => 'deleteBill',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
            die("Invalid action: $action");
        }

        public function getAll() {
            $currentUser = Auth::requirePosition(['admin', 'consumer']);
            session_start();
            $consumerId = $_SESSION["consumerId"] ?? null;
            $bills = $this->billRepo->selectWithJoin($consumerId); 
        
            include __DIR__ . "/../../public/views/bills.php";
        }
        

        public function createBill() {
            $currentUser = Auth::requirePosition(['admin']);
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['billFile'])) {
                $file = $_FILES['billFile'];
        
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    header("Location: /neeco2/bill?error=File upload failed.");
                    exit;
                }
        
                try {
                    $billsArr = readBillsCSV($file["tmp_name"]);
        
                    if (empty($billsArr)) {
                        header("Location: /neeco2/bill?error=No valid bill records found in the file.");
                        exit;
                    }
        
                    if ($this->billRepo->insert($billsArr)) {
                        $this->logger->log($_SESSION['employeeId'], "Created A Bill");
                        header("Location: /neeco2/bill?success=Bill created successfully");
                        exit;
                    } else {
                        header("Location: /neeco2/bill?error=Failed to create bill records.");
                        exit;
                    }
        
                } catch (Exception $e) {
                    $msg = urlencode("CSV Error: " . $e->getMessage());
                    header("Location: /neeco2/bill?error=$msg");
                    exit;
                }
            } else {
                header("Location: /neeco2/bill?error=No file uploaded.");
                exit;
            }
        }
        
        public function updateBill() {
            $currentUser = Auth::requirePosition(['admin']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $bill = new Bill($_POST);

                if ($this->billRepo->update($bill, $_POST['billId'])){
                    $this->logger->log($_SESSION['employeeId'], "Updated A Bill");
                    header("Location: /neeco2/bill?success=Bill updated successfully");
                    exit;
                }else{
                    header("Location: /neeco2/bill?error=Failed to Update A Bill.");
                    exit();
                }
            }
        }

        public function deleteBill(){
            $currentUser = Auth::requirePosition(['admin']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if( $this->billRepo->delete($_POST["billId"])){
                    $this->logger->log($_SESSION['employeeId'], "Deleted A Bill");
                    header("Location: /neeco2/bill?success=Bill deleted successfully");
                    exit;
                }else{
                    header("Location: /neeco2/bill?error=Failed to delete Bill.");
                    exit();
                };
        }
    }
}

$con = getPDOConnection();
$billHandler = new BillHandler();
$billHandler->handleRequest();
    
//VIEWS NOT READY


