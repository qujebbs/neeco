<?php
    require_once("src/repositories/DownloadsRepo.php");
    require_once("src/models/DownloadsModel.php");
    class DownloadsHandler {
        private $downloadsRepo;
    
        public function __construct($con) {
            $this->downloadsRepo = new DownloadsRepo($con);
        }

            public function handleRequest() {
                $action = $_REQUEST['action'] ?? 'getAll';
            
                $actions = [
                    'create' => 'createDownloads',
                    'update' => 'updateDownloads',
                    'delete' => 'deleteDownloads',
                    'getAll' => 'getAll'
                ];
            
                if (isset($actions[$action])) {
                    return $this->{$actions[$action]}();
                }
            
                die("Invalid action: $action");
            }

            public function createDownloads(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $download = new Downloads($_POST);
                    
                    $this->downloadsRepo->insert($download);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateDownloads() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $download = new Downloads($_POST);
                    
                    $this->downloadsRepo->update($download, $_POST['downloadsId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteBDownloads(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->downloadsRepo->delete($_POST['downloadsId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$downloadsHandler = new DownloadsHandler($con);
$downloadsHandler->handleRequest();
    
//VIEWS NOT READY