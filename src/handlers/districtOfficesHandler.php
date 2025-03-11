<?php
    require_once("src/repositories/DistrictOfficesRepo.php");
    require_once("src/models/DistrictOfficesModel.php");
    class DistrictOfficesHandler {
        private $districtOfficesRepo;
    
        public function __construct($con) {
            $this->districtOfficesRepo = new DistrictOfficesRepo();
        }
        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createDistrictOffices',
                'update' => 'updateDistrictOffices',
                'delete' => 'deleteDistrictOffices',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
            public function getAll(){
                $districtOffices = $this->districtOfficesRepo->selectAll(); 

                include "views/districtOffices.php";
            }

            public function createDistrictOffices(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $districtOffice = new DistrictOffices($_POST);

                    $this->districtOfficesRepo->insert($districtOffice);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function updateDistrictOffiices() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $districtOffice = new DistrictOffices($_POST);

                    $this->districtOfficesRepo->update($districtOffice, $_POST['districtId']);
            
                    header("Location: views/unimplemented.php");
                    exit;
                }
            }

            public function deleteDistrictOffices(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->districtOfficesRepo->delete($_POST['districtId']);

                    header("Location: views/unimplemented.php");
                    exit;
            }
        }
    }

$con = getPDOConnection();
$districtOfficesHandler = new DistrictOfficesHandler($con);
$districtOfficesHandler->handleRequest();
    

//VIEWS NOT READY