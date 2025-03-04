<?php 

$url = parse_url($_SERVER['REQUEST_URI'])['path'];


    $routes =[
        '/' => 'index.php',
        '/award'=> 'src/handlers/awardHandler.php',
        '/bac'=> 'src/handlers/awardHandler.php',
        '/bill'=> 'src/handlers/awardHandler.php',
        '/bod'=> 'src/handlers/awardHandler.php',
        '/complaint'=> 'src/handlers/awardHandler.php',
        '/consumer'=> 'src/handlers/awardHandler.php',
        '/consumerpayer'=> 'src/handlers/awardHandler.php',
        '/districOffice'=> 'src/handlers/awardHandler.php',
        '/download'=> 'src/handlers/awardHandler.php',
        '/news'=> 'src/handlers/awardHandler.php',
        '/rate'=> 'src/handlers/awardHandler.php',
        '/service'=> 'src/handlers/awardHandler.php',
        '/staff'=> 'src/handlers/awardHandler.php',
        '/town'=> 'src/handlers/awardHandler.php',
    ];

        
    if(array_key_exists($url, $routes)) {
        require $routes[$url];
    } else{
        http_response_code(404);
        echo "404 not found";
        die();
    }