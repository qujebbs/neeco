<?php
    require_once("src/repositories/BacRepo.php");
    require_once("src/models/BacModel.php");

    class BacHandler {
            private $bacRepo;
        
            public function __construct($con) {
                $this->bacRepo = new BacRepo();
            }

            public function handleRequest() {
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createBac',
                    'update' => 'updateBac',
                    'delete' => 'deleteBac',
                    'getAll' => 'getAll'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }
            public function getAll(){
                $bacs = $this->bacRepo->selectAll(); 

                include "views/bac.php";
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

$con = getPDOConnection();
$bacHandler = new BacHandler($con);
$bacHandler->handleRequest();
    
//NO VIEWS