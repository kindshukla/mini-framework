<?php

namespace App\Providers;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Route\Router;
use Laminas\Diactoros\Response;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\StrategyInterface;

class AppServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Router::class,
        'response',
        'request',
        'emitter'
    ];


    public function register()
    {

        $container = $this->getContainer();

        $container->share(Router::class, function () use ($container) {
            $strategy = (new ApplicationStrategy())->setContainer($container);
            return new Router;
        });

        $container->share('response', Response::class);

        $container->share('request', function() {
            return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
        });

        $container->share('emitter', SapiEmitter::class);

    }
}
