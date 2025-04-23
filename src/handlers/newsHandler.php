<?php
    require_once __DIR__ . "/../repositories/NewsRepo.php";
    require_once __DIR__ . "/../models/NewsModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";

    class NewsHandler {
        private $newsRepo;
        public $logger;
    
        public function __construct($con) {
            $this->newsRepo = new NewsRepo();
            $this->logger = new Logger();
        }

        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createNews',
                'update' => 'updateNews',
                'delete' => 'deleteNews',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
        public function getAll(){
            $newses = $this->newsRepo->selectAll(); 

            include __DIR__ . "/../../public/views/news.php";
        }
        public function createNews(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['newsPic'])) {
                $news = new News($_POST);
                try{ 
                    $fileHandler = new FileHandler('uploads/');
                    $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                    $news->newsPic = $fileHandler->uploadFile($_FILES['newsPic'], $allowedTypes);
                    if ($this->newsRepo->insert($news)){
                        $this->logger->log($_SESSION['employeeId'], "Uploaded New News");
                        header("Location: /neeco2/news?success=News created successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/news?error=Failed to upload News picture.");
                        exit();
                    };
                }catch (FileUploadException $e) {
                    header("Location: /neeco2/news?error=" . urlencode($e->getMessage()));
                    exit;
                }
            }
        }

        public function updateNews() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $news = new News($_POST);
                $tempNews = new News($this->newsRepo->selectOne($_POST['newsId']));

                try{ 
                    $fileHandler = new FileHandler('uploads/');
                    $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                    if (!empty($_FILES['districtPic']['name'])){
                        $news->newsPic = $fileHandler->uploadFile($_FILES['newsPic'], $allowedTypes);
                    }else{
                        $news->newsPic = $tempNews->newsPic;
                    }
                    if ($this->newsRepo->update($news, $_POST['newsId'])){
                        $this->logger->log($_SESSION['employeeId'], "Updated A News");
                        header("Location: /neeco2/news?success=News created successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/news?error=Failed to upload News picture.");
                        exit();
                    };
                }catch (FileUploadException $e) {
                    header("Location: /neeco2/news?error=" . urlencode($e->getMessage()));
                    exit;
                }
            }
        }

        public function deleteNews(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if($this->newsRepo->delete($_POST['newsId'])){
                    $this->logger->log($_SESSION['employeeId'], "Deleted A News");
                    header("Location: /neeco2/news?success=News deleted successfully");
                    exit;
                }else{
                    header("Location: /neeco2/news?error=Failed to delete News.");
                    exit();
                };
            }
        }
}

$con = getPDOConnection();
$newsHandler = new NewsHandler($con);
$newsHandler->handleRequest();
    

//VIEWS NOT READY