<?php
    require_once __DIR__ . "/../repositories/DownloadsRepo.php";
    require_once __DIR__ . "/../models/DownloadsModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    class DownloadsHandler {
        private $downloadsRepo;
    
        public function __construct($con) {
            $this->downloadsRepo = new DownloadsRepo();
        }

            public function handleRequest() {
                $currentUser = Auth::requirePosition(['admin']);
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

            public function getAll(){
                $downloads = $this->downloadsRepo->selectAll(); 

                include __DIR__ . "/../../public/views/downloads.php";
            }

            public function createDownloads(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfName'])) {
                    $download = new Downloads($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['application/pdf'];
                        $download->pdfName = $fileHandler->uploadFile($_FILES['pdfName'], $allowedTypes);
                        if ($this->downloadsRepo->insert($download)){
                            header("Location: /neeco2/download?success=Download created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/download?error=Failed to upload Download picture.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/download?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function updateDownloads() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $download = new Downloads($_POST);
                    
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['application/pdf'];
                        $download->pdfName = $fileHandler->uploadFile($_FILES['pdfName'], $allowedTypes);
                        if ($this->downloadsRepo->update($download, $_POST['downloadId'])){
                            header("Location: /neeco2/download?success=Download created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/download?error=Failed to upload Download picture.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/download?error=" . urlencode($e->getMessage()));
                        exit;
                    }
                }
            }

            public function deleteDownloads(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if($this->downloadsRepo->delete($_POST['downloadId'])){
                        header("Location: /neeco2/download?success=Download deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/download?error=Failed to delete Download.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$downloadsHandler = new DownloadsHandler($con);
$downloadsHandler->handleRequest();
    
//VIEWS NOT READY