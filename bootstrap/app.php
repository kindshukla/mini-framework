<?php
// main booting point of app

use Dotenv\Dotenv;

session_start();


require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..//');

} catch (\Dotenv\Exception\InvalidPathException $e) {

}

require_once __DIR__ . '/container.php';


$route = $container->get(RouteCollection::class)
