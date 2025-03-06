<?php
    require_once("src/repositories/NewsRepo.php");
    require_once("src/models/NewsModel.php");
    class NewsHandler {
        private $newsRepo;
    
        public function __construct($con) {
            $this->newsRepo = new NewsRepo($con);
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

//VIEWS NOT READY