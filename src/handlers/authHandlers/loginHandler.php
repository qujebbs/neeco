<?php
    require __DIR__ . '/../../middlewares/AuthMiddleware.php';
    require __DIR__ . '/../../repositories/AccountRepo.php';
    require __DIR__ . '/../../filters/AccountFilters.php';
    require __DIR__ . '/../../../utils/debugUtil.php';

    class LoginHandler {
        private $accountRepo;

        public function __construct() {
            $this->accountRepo = new AccountRepo();
        }

        public function handleRequest() {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                require 'views/login.php';
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->login();
            } else {
                include 'views/login.php';
            }
        }
        
        public function login(){
            // if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
            //     header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
            //     exit;
            // }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $filter = new AccountFilter([
                "username" => $username
            ]);
            
            $user = $this->accountRepo->selectByFilter($filter);
            // dumpVar($user);
            
            //no password check yet
            if ($user && $username === $user["username"]) {
                session_start();
                $token = Auth::generateToken($user["accountId"], $user["positionName"], $user["statusName"]);
                setcookie('auth_token', $token, [
                    'httponly' => true,
                    'secure' => true,
                    'samesite' => 'Strict',
                    'path' => '/'
                ]);

                $_SESSION['username'] = $user['username'];
                $_SESSION['accountId'] = $user['accountId'];
                $_SESSION['positionId'] = $user['positionId'];
                $_SESSION['employeeId'] = $user['employeeId'];
                $_SESSION['consumerId'] = $user['consumerId'];
                $_SESSION['townId'] = $user['townId'];
                
                if ($user['positionId'] === "1") {
                    header( "Location: /neeco2/complaint");
                    exit;
                }else{
                    header("Location: /neeco2/dashboard");
                    exit;
                }
            } else { 
                http_response_code(401);
                echo "invalid request method";
            }
        }else{
            dumpvar($_SERVER);
            echo "invalid request method";
        }
    }
}
$loginHandler = new LoginHandler();
$loginHandler->handleRequest();
