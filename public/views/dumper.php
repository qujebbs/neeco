<?php 
    include __DIR__ . "/../../utils/debugUtil.php";
    
    session_start();
    dumpVar($_SESSION);
