<?php

namespace App\Providers;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Route\RouteCollection;
use Laminas\Diactoros\Response;

class AppServiceProvider extends AbstractServiceProvider
{


    protected $provides = [
        RouteCollection::class,
        'response',
        'request',
        'emitter'
    ];



    public function register()
    {
        // TODO: Implement register() method.
        $container = $this->getContainer();

        $container->share(RouteCollection::class, function () use ($container) {
            return new RouteCollection($container);
        });

        $container->share('response', Response::class);

        $container->share('request', function() {
            return new ServerRequestFactory();
        });

        $container->share('emitter', SapiEmitter::class);

    }
}
