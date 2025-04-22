<?php
    require_once __DIR__ . "/../repositories/AwardRepo.php";
    require_once __DIR__ . "/../models/AwardModel.php";
    require_once __DIR__ ."/../../src/config/db.php";
    require_once __DIR__ . "/../../utils/debugUtil.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";
    require_once __DIR__ . "/../logs/logger.php";
    

    class AwardHandler {
        private $awardRepo;
        public $logger;

        public function __construct() {
            $this->awardRepo = new AwardRepo();
            $this->logger = new Logger();
        }
        public function handleRequest() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $currentUser = Auth::requirePosition(['admin']);
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
                    $this->logger->log($_SESSION['employeeId'], "Created New Award {$award->awardName}");
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
                    $this->logger->log($_SESSION['employeeId'], "Updated New Award awardId = {$_POST['awardId']}");
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
            
            public function deleteAward() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['awardId'])) {
                    $this->logger->log($_SESSION['employeeId'], "Deleted Award awardId = {$_POST['awardId']}");
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
$awardHandler = new AwardHandler();
$awardHandler->handleRequest();
