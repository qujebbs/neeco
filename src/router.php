<?php
    require_once ("src/config/db.php");

$url = parse_url($_SERVER['REQUEST_URI'])['path'];


    $routes =[
        '/' => 'index.php',
        '/award'=> 'src/handlers/AwardHandler.php',
        '/bac'=> 'src/handlers/BacHandler.php',
        '/bill'=> 'src/handlers/BillHandler.php',
        '/bod'=> 'src/handlers/BodHandler.php',
        '/complaint'=> 'src/handlers/ComplaintHandler.php',
        '/consumer'=> 'src/handlers/ConsumerHandler.php',
        '/consumer-payer'=> 'src/handlers/ConsumerPayerHandler.php',
        '/district-office'=> 'src/handlers/DistrictOfficeHandler.php',
        '/download'=> 'src/handlers/DownloadHandler.php',
        '/news'=> 'src/handlers/Newsandler.php',
        '/rate'=> 'src/handlers/RateHandler.php',
        '/service'=> 'src/handlers/ServiceHandler.php',
        '/staff'=> 'src/handlers/StaffHandler.php',
        '/town'=> 'src/handlers/TownHandler.php',
    ];

        
    if(array_key_exists($url, $routes)) {
        require $routes[$url];
    } else{
        http_response_code(404);
        echo "404 not found";
        die();
    }