<?php
    require_once("src/repositories/RateRepo.php");
    require_once("src/models/RateModel.php");
    class RateHandler {
        private $rateRepo;
    
        public function __construct($con) {
            $this->rateRepo = new RateRepo($con);
        }

            public function createRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $rate = new Rate($_POST);

                    $this->rateRepo->insert($rate);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateRate() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $rate = new Rate($_POST);

                    $this->rateRepo->update($rate, $_POST['rateId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->rateRepo->delete($_POST['rateId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY