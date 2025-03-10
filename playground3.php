<?php
    // include ("src/config/db.php");
    // include ("src/handlers/downloadHandler.php");
    include ("utils/debugUtil.php");

    dumpVar(parse_url($_SERVER['REQUEST_URI'])['path']);
