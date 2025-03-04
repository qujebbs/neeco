<?php
    class DownloadsHandler {
        private $downloadsRepo;
    
        public function __construct($con) {
            $this->downloadsRepo = new DownloadsRepo($con);
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

//VIEWS NOT READY