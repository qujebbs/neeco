<?php
    require_once __DIR__ . "/../epositories/BillRepo.php";
    require_once __DIR__ . "/../models/BillModel.php";
    require_once __DIR__ . "/../../src/config/db.php";
    class BillHandler {
        private $billRepo;
    
        public function __construct() {
            $this->billRepo = new BillRepo();
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
            $consumerId = $_SESSION["consumerId"] ?? null;
            $bills = $this->billRepo->selectWithJoin($consumerId); 
        
            include __DIR__ . "/../../public/views/bills.php";
        }
        

        public function createBill() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['billFile'])) {
                $billsArr = readBillsCSV($_FILES['csv_file']["tmp_name"]);
    
                $this->billRepo->insert($billsArr);
    
                header("Location: views/unimplemented.php");
                exit;
            }
        }
            public function updateBill() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $Bll = new Bill($_POST);

                    $this->billRepo->update($Bll, $_POST['billId']);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBill($con){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    $this->billRepo->delete($_POST["billId"]);
                    
                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$billHandler = new BillHandler($con);
$billHandler->handleRequest();
    
//VIEWS NOT READY


