<?php
    require_once("src/repositories/ConsumerRepo.php");
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
                    $statuses = [
                        "pending" => 1,
                        "verified" => 2,
                        "archived" => 3
                    ];
                
                    $status = $_GET['status'] ?? "pending";
                
                    if (isset($status) && !isset($statuses[$status])) {
                        http_response_code(400);
                        echo "Invalid Request.";
                        exit;
                    }
                
                    $filter = new ConsumerFilter([
                        "accountStatusId" => $statuses[$status] ?? null
                    ]);
                
                    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                    $limit = 1000;
                    $offset = ($page - 1) * $limit;
                
                    $accounts = $this->consumerRepo->selectByFilters($filter, $limit, $offset);
                
                    include "views/accounts.php";
            }
            
            
            // public function getConsumers() {
            //     if (isset($_GET["status"])){
            //         $statuses = [
            //             "pending" => 1,
            //             "verified" => 2,
            //             "archived" => 3
            //         ];
            
            //         $status = $_GET['status'] ?? null;

            //         if (!isset($statuses[$status])) {
            //             http_response_code(400);
            //             echo "Invalid status.";
            //             exit;
            //         }
            
            //         $filter = new ConsumerFilter([
            //             "accountStatusId" => $statuses[$status]
            //         ]);
            
            //         $accounts = $this->consumerRepo->selectByFilters($filter);

            //         include "views/accounts.php";
            // }else{
            //     $towns = $this->consumerRepo->selectAll(); 

            //     include "views/unimplemented";
            // }
            // }
    }

$con = getPDOConnection();
$consumerHandler = new ConsumerHandler($con);
$consumerHandler->handleRequest();


//VIEWS NOT READY