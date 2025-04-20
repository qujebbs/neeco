<?php

    $url = parse_url($_SERVER['REQUEST_URI'])['path'];

    $routes =[
        '/neeco2' => '../public/index.php',
        '/neeco2/award'=> '../src/handlers/AwardHandler.php',
        '/neeco2/bac'=> '../src/handlers/BacHandler.php',
        '/neeco2/bill'=> '../src/handlers/BillHandler.php',
        '/neeco2/bod'=> '../src/handlers/BodHandler.php',
        '/neeco2/complaint'=> '../src/handlers/ComplaintHandler.php',
        '/neeco2/consumer'=> '../src/handlers/ConsumerHandler.php',
        '/neeco2/consumer-payer'=> '../src/handlers/ConsumerPayersHandler.php',
        '/neeco2/district-office'=> '../src/handlers/DistrictOfficesHandler.php',
        '/neeco2/download'=> '../src/handlers/DownloadHandler.php',
        '/neeco2/news'=> '../src/handlers/NewsHandler.php',
        '/neeco2/rate'=> '../src/handlers/RateHandler.php',
        '/neeco2/service'=> '../src/handlers/ServiceHandler.php',
        '/neeco2/staff'=> '../src/handlers/StaffHandler.php',
        '/neeco2/town'=> '../src/handlers/TownsHandler.php',
        '/neeco2/playground' => '../public/views/dumper.php',
        '/neeco2/login' => '../src/handlers/authHandlers/loginHandler.php',
        '/neeco2/logout' => '../src/handlers/authHandlers/logoutHandler.php',
        '/neeco2/home' => '../src/handlers/homeHandler.php',
        '/neeco2/register' => '../src/handlers/authHandlers/registerHandler.php',
        '/neeco2/dashboard' => '../src/handlers/dashboardHandler.php',
        '/neeco2/consumer-bill' => '../src/handlers/consumerBillHandler.php',
        '/neeco2/profile' => '../src/handlers/profileHandler.php',
        '/neeco2/generate-key' => '../src/services/authService.php',

        '/neeco2/test' => '../public/views/dumper.php'

    ];

        
    if(array_key_exists($url, $routes)) {
        require $routes[$url];
    } else{
        http_response_code(404);
        echo "404 not found :( <br>";
        echo $url;
        die();
    }

    //TODO: SETTING NULL TO CONSUMERID OR EMPLOYEEID IN ACCOUNTS

    //SECURITY
    //CSRF TOKEN ////////////
    //CSP
    //authorization
    //CHANGE THE SELECT * to not expose unused data
    //upgrade router
    //CSRF
    //htaccess protection and file uploads security
    // secure parameters and do constant values


    //authorization not user friendly
    //displaying pdfs
    //no adding consumers yet
    //no error handlings or error handling not user friendly
    //required fields
    //fix file upload paths
    //user management
    //approve and archive multiple users
    //error on consumerHandler
    // VIEW-RATE.PHP

    //REGISTER THROUGH ACCOUNTS ONLY NOT CONSUMERS
    //TODO PAGES: home, senior citizen, RA, Rate archive, Downloads, linking of some pages with ID, employee dashboard