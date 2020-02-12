<?php
// main booting point of app

use Dotenv\Dotenv;
use League\Route\Router;

session_start();


require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..//');
} catch (\Dotenv\Exception\InvalidPathException $e) {
    //
}

require_once __DIR__ . '/container.php';


$route = $container->get(Router::class);

//var_dump($route);

require_once __DIR__ . '/../routes/web.php';

$response = $route->dispatch($container->get('request'));

$response = $response->respond();
