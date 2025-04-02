<?php 
    include __DIR__ . "/../../utils/debugUtil.php";
    include __DIR__ . "/../../src/middlewares/AuthMiddleware.php";

    $currentUser = Auth::requirePosition(['Admin']);
    $currentUser = Auth::requireAuth();
    dumpVar($currentUser);
