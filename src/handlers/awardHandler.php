<?php
    require_once __DIR__ . "/../repositories/AwardRepo.php";
    require_once __DIR__ . "/../models/AwardModel.php";
    require_once __DIR__ ."/../../src/config/db.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    

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

                    if($this->awardRepo->insert($award)){
                        header("Location: /neeco2/award?success=Service created successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/award?error=Failed to upload Service.");
                        exit();
                    };
                }
            }

            public function updateAward() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $award = new Award($_POST);
                    // dumpVar($award);
                    if($this->awardRepo->update($award, $_POST['awardId'])){
                        header("Location: /neeco2/award?success=Award updated successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/award?error=Failed to update Award.");
                        exit();
                    };
                }
            }
            
            //returned deleted rows unused
            public function deleteAward() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['awardId'])) {

                    if($this->awardRepo->delete($_POST['awardId'])){
                        header("Location: /neeco2/award?success=Award deleted successfully");
                        exit;
                    }else{
                        header("Location: /neeco2/award?error=Failed to delete Award.");
                        exit();
                    };
                }
            }
        }

$con = getPDOConnection();
$awardHandler = new AwardHandler($con);
$awardHandler->handleRequest();
            
//VIEWS NOT YET READY
