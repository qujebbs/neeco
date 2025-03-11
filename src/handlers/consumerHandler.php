<?php
    require_once("src/repositories/ConsumerRepo.php");
    require_once 'src/filters/ConsumerFilters.php';
    require_once("src/models/ConsumerModel.php");
    class ConsumerHandler {
        private $consumerRepo;
    
        public function __construct($con) {
            $this->consumerRepo = new ConsumerRepo();
        }
        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getConsumers';
        
            $actions = [
                'create' => 'createConsumer',
                'update' => 'updateConsumer',
                'delete' => 'deleteConsumer',
                'getConsumers' => 'getConsumers'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }

            // public function getAll(){
            //     $towns = $this->consumerRepo->selectAll(); 

            //     include "views/unimplemented";
            // }

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
            public function getConsumers() {
                if (isset($_GET["status"])){
                    $statuses = [
                        "pending" => 1,
                        "active" => 2,
                        "archived" => 3
                    ];
            
                    $status = $_GET['status'] ?? null;

                    if (!isset($statuses[$status])) {
                        http_response_code(400);
                        echo "Invalid status.";
                        exit;
                    }
            
                    $filter = new ConsumerFilter([
                        "statusId" => $statuses[$status],
                        "consumerId" => 1
                    ]);
            
                    $accounts = $this->consumerRepo->selectByFilters($filter);

                    include "views/accounts.php";
                }else{
                    $towns = $this->consumerRepo->selectAll(); 

                    include "views/unimplemented";
                }
            }
    }

$con = getPDOConnection();
$consumerHandler = new ConsumerHandler($con);
$consumerHandler->handleRequest();


//VIEWS NOT READY