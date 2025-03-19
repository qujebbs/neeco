<?php
    require 'src/middlewares/AuthMiddleware.php';
    require 'src/repositories/AccountRepo.php';
    require 'src/filters/AccountFilters.php';
    require 'utils/debugUtil.php';

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
                $token = Auth::generateToken($user["accountId"], $user["positionName"], $user["statusName"]);
                setcookie('auth_token', $token, [
                    'httponly' => true,
                    'secure' => true,
                    'samesite' => 'Strict',
                    'path' => '/'
                ]);
                
                header("Location: /neeco2/playground");
                exit();
            } else { 
                http_response_code(401);
                echo "invalid request method";
            }
        }else{
            echo "invalid request method";
        }
    }
}
$loginHandler = new LoginHandler();
$loginHandler->handleRequest();
