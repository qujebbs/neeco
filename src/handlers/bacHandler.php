<?php
    require_once("src/repositories/BacRepo.php");
    require_once("src/models/BacModel.php");

    class BacHandler {
            private $bacRepo;
        
            public function __construct($con) {
                $this->bacRepo = new BacRepo($con);
            }

            public function createBac(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $bac = new Bac($_POST);
            
                    $this->bacRepo->insert($bac);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateBac() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                    $bac = new Bac($_POST);
            
                    $this->bacRepo->update($bac, $_POST['awardId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBac($con){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->bacRepo->delete($_POST['awardId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//NO VIEWS