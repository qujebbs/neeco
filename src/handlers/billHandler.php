<?php
    require_once("src/repositories/BillRepo.php");
    require_once("src/models/BillModel.php");
    class BillHandler {
        private $billRepo;
    
        public function __construct($con) {
            $this->billRepo = new BillRepo($con);
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

        public function createBill() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
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


