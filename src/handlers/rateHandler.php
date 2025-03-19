<?php
    require_once __DIR__ . "/../repositories/RateRepo.php";
    require_once __DIR__ . "/../models/RateModel.php";
    class RateHandler {
        private $rateRepo;
    
        public function __construct($con) {
            $this->rateRepo = new RateRepo();
        }

        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createRate',
                'update' => 'updateRate',
                'delete' => 'deleteRate',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
            public function getAll(){
                $rates = $this->rateRepo->selectAll(); 

                include __DIR__ . "/../../public/views/rate.php";
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

$con = getPDOConnection();
$rateHandler = new RateHandler($con);
$rateHandler->handleRequest();
    
//VIEWS NOT READY