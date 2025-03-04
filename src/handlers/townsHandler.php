<?php
    class townsHandler {
        private $townsRepo;
    
        public function __construct($con) {
            $this->townsRepo = new TownsRepo($con);
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

//VIEWS NOT READY