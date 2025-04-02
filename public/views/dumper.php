<?php 
    include __DIR__ . "/../../utils/debugUtil.php";
    include __DIR__ . "/../../src/middlewares/AuthMiddleware.php";
    session_start();
    // $currentUser = Auth::requirePosition(['admin']);
    // $currentUser = Auth::requireAuth();
    dumpVar($_COOKIE);
    dumpVar($_SESSION);
