<?php
    class BillHandler {
        private $billRepo;
    
        public function __construct($con) {
            $this->billRepo = new BillRepo($con);
        }

            public function createBod($con){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateBod($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBod($con){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY