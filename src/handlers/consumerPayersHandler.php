<?php
    require_once("src/repositories/ConsumerPayersRepo.php");
    require_once("src/models/ConsumerPayersModel.php");
    class ConsumerPayersHandler {
        private $consumerPayersRepo;
    
        public function __construct($con) {
            $this->consumerPayersRepo = new ConsumerPayersRepo();
        }

            public function handleRequest() {
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createConsumerPayers',
                    'update' => 'updateConsumerPayers',
                    'delete' => 'deleteConsumerPayers',
                    'getAll' => 'getAll'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }

            public function getAll(){
                $consumerPayers = $this->consumerPayersRepo->selectAll(); 

                include "views/consumerPayers.php";
            }

            public function createConsumerPayers(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $consumerPayer = new ConsumerPayers($_POST);

                    $this->consumerPayersRepo->insert($consumerPayer);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateConsumerPayers($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $consumerPayer = new ConsumerPayers($_POST);

                    $this->consumerPayersRepo->update($consumerPayer, $_POST['consumerPayersId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteConsumerPayers(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->consumerPayersRepo->delete($_POST['consumerPayersId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$consumerPayersHandler = new ConsumerPayersHandler($con);
$consumerPayersHandler->handleRequest();
    
//VIEWS NOT READY