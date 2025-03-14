<?php
    include "utils/debugUtil.php";
    include "src/middlewares/AuthMiddleware.php";

    $token = Auth::generateToken(123, ['admin', 'user'], "verified");
    echo "Generated Token: " . $token . "\n \n";

    $payload = Auth::verifyToken($token);
    echo "Token payload:\n";
    print_r($payload);