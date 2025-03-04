<?php
    class ConsumerHandler {
        private $consumerRepo;
    
        public function __construct($con) {
            $this->consumerRepo = new ConsumerRepo($con);
        }

            public function createConsumer(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    //would prolly use csv not sure

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateConsumer() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    $Consumer = new Consumer($_POST);

                    $this->consumerRepo->update($Consumer);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteConsumer(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->consumerRepo->delete($_POST);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY