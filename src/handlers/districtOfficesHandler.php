<?php
    require_once __DIR__ . "/../repositories/DistrictOfficesRepo.php";
    require_once __DIR__ . "/../models/DistrictOfficesModel.php";
    require_once __DIR__ . "/../utils/fileHandler.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
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

                include __DIR__ . "/../../public/views/districtOffices.php";
            }

            public function createDistrictOffices(){
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['districtPic'])) {
                    $districtOffice = new DistrictOffices($_POST);
                    try{ 
                        $fileHandler = new FileHandler('uploads/');
                        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
                        $districtOffice->districtPic = $fileHandler->uploadFile($_FILES['districtPic'], $allowedTypes);
                        if ($this->districtOfficesRepo->insert($districtOffice)){
                            header("Location: /neeco2/district-office?success=District Office created successfully");
                            exit;
                        }else{
                            header("Location: /neeco2/district-office?error=Failed to upload District Office.");
                            exit();
                        };
                    }catch (FileUploadException $e) {
                        header("Location: /neeco2/district-office?error=" . urlencode($e->getMessage()));
                        exit;
                    }
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

                    if($this->districtOfficesRepo->delete($_POST['districtId'])){
                        header("Location: /neeco2/district-office?success=District Office deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/district-office?error=Failed to delete District Offie.");
                        exit();
                    };
            }
        }
    }

$con = getPDOConnection();
$districtOfficesHandler = new DistrictOfficesHandler($con);
$districtOfficesHandler->handleRequest();
    

//VIEWS NOT READY