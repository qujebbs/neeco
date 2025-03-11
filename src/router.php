<?php

    $url = parse_url($_SERVER['REQUEST_URI'])['path'];

    $routes =[
        '/' => 'index.php',
        '/neeco2/award'=> 'src/handlers/AwardHandler.php',
        '/neeco2/bac'=> 'src/handlers/BacHandler.php',
        '/neeco2/bill'=> 'src/handlers/BillHandler.php',
        '/neeco2/bod'=> 'src/handlers/BodHandler.php',
        '/neeco2/complaint'=> 'src/handlers/ComplaintHandler.php',
        '/neeco2/consumer'=> 'src/handlers/ConsumerHandler.php',
        '/neeco2/consumer-payer'=> 'src/handlers/ConsumerPayersHandler.php',
        '/neeco2/district-office'=> 'src/handlers/DistrictOfficesHandler.php',
        '/neeco2/download'=> 'src/handlers/DownloadHandler.php',
        '/neeco2/news'=> 'src/handlers/NewsHandler.php',
        '/neeco2/rate'=> 'src/handlers/RateHandler.php',
        '/neeco2/service'=> 'src/handlers/ServiceHandler.php',
        '/neeco2/staff'=> 'src/handlers/StaffHandler.php',
        '/neeco2/town'=> 'src/handlers/TownsHandler.php',
    ];

        
    if(array_key_exists($url, $routes)) {
        require $routes[$url];
    } else{
        http_response_code(404);
        echo "404 not found :( ";
        echo "<pre>". var_dump($url) . "</pre>";
        die();
    }

    //required fields
    //