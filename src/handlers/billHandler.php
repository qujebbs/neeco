<?php
    class BillHandler {
        private $billRepo;
    
        public function __construct($con) {
            $this->billRepo = new BillRepo($con);
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
//VIEWS NOT READY


