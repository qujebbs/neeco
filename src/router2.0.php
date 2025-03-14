<?php

class Router
{
    private $routes = [];

    public function get($path, $handler, $middleware = null)
    {
        $this->routes['GET'][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function post($path, $handler, $middleware = null)
    {
        $this->routes['POST'][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function dispatch($url, $method)
    {
        if (isset($this->routes[$method][$url])) {
            $route = $this->routes[$method][$url];

            if ($route['middleware'] && is_callable($route['middleware'])) {
                $route['middleware']();
            }

            require $route['handler'];
            return;
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}

$router = new Router();

$router->get('/', 'index.php');
$router->get('/neeco2/award', 'src/handlers/AwardHandler.php');
$router->get('/neeco2/bac', 'src/handlers/BacHandler.php');
$router->get('/neeco2/bill', 'src/handlers/BillHandler.php');

$router->get('/neeco2/protected', 'src/handlers/ProtectedHandler.php', function () {
    require_once 'AuthMiddleware.php';
    
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        die(json_encode(['error' => 'Authorization header missing']));
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);

    $payload = Auth::verifyToken($token);

    if (!$payload) {
        http_response_code(401);
        die(json_encode(['error' => 'Invalid or expired token']));
    }

    $_REQUEST['user'] = $payload;
});

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($url, $method);
