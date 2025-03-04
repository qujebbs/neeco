<?php
    class StaffHandler {
        private $staffRepo;
    
        public function __construct($con) {
            $this->staffRepo = new StaffRepo($con);
        }

            public function createStaff(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $staff = new Staff($_POST);

                    $this->staffRepo->insert($staff);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateBod() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $staff = new Staff($_POST);

                    $this->staffRepo->update($staff, $_POST['staffId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBod(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->staffRepo->delete($_POST['staffId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY