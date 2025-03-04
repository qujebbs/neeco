<?php
    class ServiceHandler {
        private $serviceRepo;
    
        public function __construct($con) {
            $this->serviceRepo = new ServiceRepo($con);
        }

            public function createService(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $service = new Service($_POST);

                    $this->serviceRepo->insert($service);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateService() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $service = new Service($_POST);

                    $this->serviceRepo->update($service, $_POST['rateId']);
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteRate(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->serviceRepo->delete($_POST['servceId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

//VIEWS NOT READY