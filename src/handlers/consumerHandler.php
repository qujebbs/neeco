<?php
    require_once("src/repositories/ConsumerRepo.php");
    require_once("src/models/ConsumerModel.php");
    class ConsumerHandler {
        private $consumerRepo;
    
        public function __construct($con) {
            $this->consumerRepo = new ConsumerRepo($con);
        }
        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createConsumer',
                'update' => 'updateConsumer',
                'delete' => 'deleteConsumer',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }

            public function createConsumer(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    //would prolly use csv not sure

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateConsumer() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    $Consumer = new Consumer($_POST);

                    $this->consumerRepo->update($Consumer);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteConsumer(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->consumerRepo->delete($_POST);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$consumerHandler = new ConsumerHandler($con);
$consumerHandler->handleRequest();


//VIEWS NOT READY