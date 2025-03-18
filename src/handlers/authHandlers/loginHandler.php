<?php
    require 'src/middlewares/AuthMiddleware.php';

    class AwardHandler {
        private $accountRepo;

        public function __construct() {
            $this->accountRepo = new AccountRepo();
        }
        
        public function login($mockUser){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $accountRepo = new AccountRepo();
            $filter = new AccountFilter([
                "username" => $username
            ]);
            
            $user = $accountRepo->selectByFilter($filter);
            if ($username === $user['username'] && $password === $user['password']) {
                $token = Auth::generateToken($user['accountId'], $user['positionName']);
            } else {
                http_response_code(401);
            }
        }
    }
}

    
