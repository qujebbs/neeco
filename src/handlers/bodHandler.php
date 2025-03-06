<?php
    require_once("src/repositories/BodRepo.php");
    require_once("src/models/BodModel.php");
    class BodHandler {
        private $bodRepo;
    
        public function __construct($con) {
            $this->bodRepo = new BodRepo($con);
        }

            public function createBod($con){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $bod = new Bod($_POST);

                    $this->bodRepo->insert($bod);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateBod() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $bod = new Bod($_POST);

                    $this->bodRepo->update($bod, $_POST['bodId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBod(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->bodRepo->delete($_POST['bodId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY