<?php
require __DIR__ . '/../../repositories/AccountRepo.php';
require __DIR__ . '/../../repositories/PasswordResetRepo.php';

class ResetPasswordHandler {
    private $accountRepo;
    private $passwordResetRepo;

    public function __construct() {
        $this->accountRepo = new AccountRepo();
        $this->passwordResetRepo = new PasswordResetRepo();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require 'views/reset-password.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->resetPassword($_POST);
        }
    }

    public function resetPassword($request) {
        $token = $request['token'] ?? '';
        $newPassword = $request['newPassword'] ?? '';

        $reset = $this->passwordResetRepo->getByToken($token);
        if (!$reset || strtotime($reset['expiresAt']) < time()) {
            header("Location: /neeco2/reset-password?error=Invalid or expired token");
            exit;
        }

        $user = $this->accountRepo->findByAccountId($reset['accountId']);
        if (!$user) {
            header("Location: /neeco2/reset-password?error=User not found");
            exit;
        }

        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->accountRepo->updatePassword($user['accountId'], $hashed);
        $this->passwordResetRepo->deleteToken($token);

        header('Location: /neeco2/reset-success');
        exit;        
    }
}
$handler = new ResetPasswordHandler();
$handler->handleRequest();
