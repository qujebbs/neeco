<?php
    require_once("src/repositories/ConsumerPayerRepo.php");
    require_once("src/models/ConsumerPayersModel.php");
    class ConsumerPayersHandler {
        private $consumerPayersRepo;
    
        public function __construct($con) {
            $this->consumerPayersRepo = new ConsumerPayersRepo($con);
        }

            public function createConsumerPayers(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $consumerPayer = new ConsumerPayers($_POST);

                    $this->consumerPayersRepo->insert($consumerPayer);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateConsumerPayers($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $consumerPayer = new ConsumerPayers($_POST);

                    $this->consumerPayersRepo->update($consumerPayer, $_POST['consumerPayersId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteConsumerPayers(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->consumerPayersRepo->delete($_POST['consumerPayersId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY