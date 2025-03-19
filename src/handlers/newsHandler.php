<?php
    require_once __DIR__ . "/../repositories/NewsRepo.php";
    require_once __DIR__ . "/../models/NewsModel.php";
    class NewsHandler {
        private $newsRepo;
    
        public function __construct($con) {
            $this->newsRepo = new NewsRepo();
        }

        public function handleRequest() {
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $news = new News($_POST);

                $this->newsRepo->insert($news);

                header("Location: views/unimplemented.php");
                exit;
            }
        }

        public function updateNews($con) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $news = new News($_POST);

                $this->newsRepo->update($news, $_POST['newsId']);
        
                header("Location: views/unimplemented.php");
                exit;
            }
        }

        public function deleteBod($con){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $this->newsRepo->delete($_POST['newsId']);

                header("Location: views/unimplemented.php");
                exit;
            }
        }
}

$con = getPDOConnection();
$newsHandler = new NewsHandler($con);
$newsHandler->handleRequest();
    

//VIEWS NOT READY