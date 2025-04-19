<?php
require __DIR__ . '/../../middlewares/AuthMiddleware.php';

class LogoutHandler {
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->logout();
        } else {
            http_response_code(405);
            echo "Only POST requests are allowed for logout.";
        }
    }

    private function logout() {
        session_start();

        $_SESSION = [];

        session_destroy();

        setcookie('auth_token', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'secure' => true,
            'samesite' => 'Strict',
        ]);

        header("Location: /neeco2/login");
        exit;
    }
}

$logoutHandler = new LogoutHandler();
$logoutHandler->handleRequest();
