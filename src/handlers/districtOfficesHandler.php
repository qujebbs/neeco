<?php
    require_once("src/repositories/DistrictOfficesRepo.php");
    require_once("src/models/DistrictOfficesModel.php");
    class DistrictOfficesHandler {
        private $districtOfficesRepo;
    
        public function __construct($con) {
            $this->districtOfficesRepo = new DistrictOfficesRepo($con);
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

//VIEWS NOT READY