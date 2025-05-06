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
        
        public function logins(){
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
            if ($user && $username === $user["username"] && password_verify($password, $user["password"])) {
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

                if ($user['accountStatusId'] == 1) {
                    header('Location: /neeco2/pending');
                    exit;
                }

                if ($user['accountStatusId'] == 3) {
                    header('Location: /neeco2/login?error=This account has been Archived.');
                    exit;
                }
                
                if ($user['positionId'] === "1") {
                    header( "Location: /neeco2/complaint");
                    exit;
                }else{
                    header("Location: /neeco2/dashboard");
                    exit;
                }
            }else { 
                header("Location: /neeco2/login?error=Invalid Username or Password.");
            }
        }else{
            dumpvar($_SERVER);
            echo "invalid request method";
        }
    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $ip = $_SERVER['REMOTE_ADDR'];
    
            $maxAttempts = 5;
            $lockoutTime = 300;
    
            if (!isset($_SESSION['login_attempts'][$ip])) {
                $_SESSION['login_attempts'][$ip] = ['count' => 0, 'last_attempt' => time()];
            }
    
            $attemptData = $_SESSION['login_attempts'][$ip];
    
            if ($attemptData['count'] >= $maxAttempts && (time() - $attemptData['last_attempt']) < $lockoutTime) {
                $remaining = $lockoutTime - (time() - $attemptData['last_attempt']);
                header("Location: /neeco2/login?error=Too many attempts. Try again in $remaining seconds.");
                exit;
            }

            $_SESSION['login_attempts'][$ip]['last_attempt'] = time();
    
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $filter = new AccountFilter(["username" => $username]);
            $user = $this->accountRepo->selectByFilter($filter);
    
            if ($user && $username === $user["username"] && password_verify($password, $user["password"])) {
                unset($_SESSION['login_attempts'][$ip]);
    
                $token = Auth::generateToken($user["accountId"], $user["positionName"], $user["statusName"]);
                setcookie('auth_token', $token, [
                    'httponly' => true,
                    // 'secure' => true,
                    'samesite' => 'Strict',
                    'path' => '/'
                ]);
    
                $_SESSION['username'] = $user['username'];
                $_SESSION['accountId'] = $user['accountId'];
                $_SESSION['positionId'] = $user['positionId'];
                $_SESSION['employeeId'] = $user['employeeId'];
                $_SESSION['consumerId'] = $user['consumerId'];
                $_SESSION['townId'] = $user['townId'];
    
                if ($user['accountStatusId'] == 1) {
                    header('Location: /neeco2/pending');
                    exit;
                }
    
                if ($user['accountStatusId'] == 3) {
                    header('Location: /neeco2/login?error=This account has been Archived.');
                    exit;
                }
    
                if ($user['positionId'] === "2") {
                    header("Location: /neeco2/dashboard");
                } else {
                    header("Location: /neeco2/profile");
                }
                exit;
            } else {
                $_SESSION['login_attempts'][$ip]['count']++;
                header("Location: /neeco2/login?error=Invalid Username or Password.");
                exit;
            }
        } else {
            dumpvar($_SERVER);
            echo "invalid request method";
        }
    }    
}
$loginHandler = new LoginHandler();
$loginHandler->handleRequest();
