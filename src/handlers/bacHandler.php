<?php
    require_once __DIR__ . "/../repositories/BacRepo.php";
    require_once __DIR__ . "/../models/BacModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";

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

                include __DIR__ . "/../../public/views/bac.php";
            }

            public function createBac(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bacPdf'])) {
                    $bac = new Bac($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['application/pdf'];
                        $bac->bacPdf = $fileHandler->uploadFile($_FILES['bacPdf'], $allowedTypes);
                        if ($this->bacRepo->insert($bac)){
                            header("Location: /neeco2/bac?success=Download created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/bac?error=Failed to upload Download picture.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/bac?error=" . urlencode($e->getMessage()));
                        exit;
                    }
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

            public function deleteBac(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if($this->bacRepo->delete($_POST['bacId'])){
                        header("Location: /neeco2/bac?success=BAC deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/bac?error=Failed to delete BAC.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$bacHandler = new BacHandler($con);
$bacHandler->handleRequest();
    
//NO VIEWS