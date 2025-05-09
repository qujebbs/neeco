<?php
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";

class ProfileHandler{

    public function loadProfile(){
        $currentUser = Auth::requireAuth();
        include __DIR__ . "/../../public/views/profile.php";
    }
    
}

$aboutHandler = new ProfileHandler();
$aboutHandler->loadProfile();