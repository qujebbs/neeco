<?php
require __DIR__ . '/../../repositories/AccountRepo.php';
require __DIR__ . '/../../repositories/PasswordResetRepo.php';
require __DIR__ . '/../../services/EmailService.php';

class ForgotPasswordHandler {
    private $accountRepo;
    private $passwordResetRepo;
    private $emailService;

    public function __construct() {
        $this->accountRepo = new AccountRepo();
        $this->passwordResetRepo = new PasswordResetRepo();
        $this->emailService = new EmailService();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require 'views/forgot-password.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->forgotPassword($_POST);
        }
    }

    public function forgotPassword($request) {
        $email = $request['email'] ?? '';
        $user = $this->accountRepo->findByEmail($email);

        if (!$user) {
            header("Location: /neeco2/forgot-password?error=Email not found");
            exit;
        }

        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $this->passwordResetRepo->storeToken($user['accountId'], $token, $expiresAt);
        if($this->emailService->sendResetEmail($email, $token)){
            header("Location: /neeco2/forgot-password?success=Reset link sent");
            exit;
        }else{
            header("Location: /neeco2/forgot-password?error=Failed to send email");
            exit;
        }
        
    }
}
$handler = new ForgotPasswordHandler();
$handler->handleRequest();
