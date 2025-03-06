<?php
    require_once("src/repositories/TownsRepo.php");
    require_once("src/models/TownsModel.php");

    class TownsHandler {
        private $townsRepo;
    
        public function __construct($con) {
            $this->townsRepo = new TownsRepo($con);
        }
            public function handleRequest() {
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createTowns',
                    'update' => 'updateTowns',
                    'delete' => 'deleteTowns',
                    'getAll' => 'getAll'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }

            public function getAll(){
                $towns = $this->townsRepo->selectAll(); 

                include "views/towns.php";
            }
        

            public function createTown(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $town = new Towns($_POST);

                    $this->townsRepo->insert($town);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateTown() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $town = new Towns($_POST);

                    $this->townsRepo->update($town, $_POST['townId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBod(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->townsRepo->delete($_POST['townId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }


$con = getPDOConnection();
$townHandler = new TownsHandler($con);
$townHandler->handleRequest();

//VIEWS NOT READY