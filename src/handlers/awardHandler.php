<?php
    require_once __DIR__ . "/../repositories/AwardRepo.php";
    require_once __DIR__ . "/../models/AwardModel.php";
    require_once __DIR__ ."/../../src/config/db.php";
    

    class AwardHandler {
        private $awardRepo;

        public function __construct($con) {
            $this->awardRepo = new AwardRepo();
        }
        public function handleRequest() {
            $action = $_REQUEST['action'] ?? 'getAll';
        
            $actions = [
                'create' => 'createAward',
                'update' => 'updateAward',
                'delete' => 'deleteAward',
                'getAll' => 'getAll'
            ];
        
            if (isset($actions[$action])) {
                return $this->{$actions[$action]}();
            }
        
            die("Invalid action: $action");
        }
            public function getAll(){
                $awards = $this->awardRepo->selectAll(); 

                include __DIR__ . "/../../public/views/awards.php";
            }
            public function createAward() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $award = new Award($_POST);

                    $this->awardRepo->insert($award);

                    header("Location: /neeco2/award");
                    exit;
                }
            }

            public function updateAward() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $award = new Award($_POST);

                    $this->awardRepo->update($award, $_POST['awardId']);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }
            
            //returned deleted rows unused
            public function deleteAward($con) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['awardId'])) {

                    $deletedRows = $this->awardRepo->delete($$_POST['awardId']);

                    header("Location: views/unimplemented.php");
                    exit;
                }
            }
        }

$con = getPDOConnection();
$awardHandler = new AwardHandler($con);
$awardHandler->handleRequest();
            
//VIEWS NOT YET READY
