<?php

namespace Tbd\Main;

use FrameworkX\App;
use FrameworkX\Container;
use React\Http\Message\Response;
use Tbd\Main\Products\ProductLookupDataProviderAbstraction;
use Tbd\Main\Products\ProductRepository;

class Application
{
    protected App $app;

    public function __construct()
    {
        $container = new Container([
            Products\ProductsListController::class => function (ProductRepository $repository) {
                return new Products\ProductsListController($repository);
            },
            Products\ProductLookupController::class => function (ProductRepository $repository) {
                return new Products\ProductLookupController($repository, new ProductLookupDataProviderAbstraction());
            }
        ]);

        $this->app = new App($container);
        $this->app->get('/products',  Products\ProductsListController::class);
        $this->app->get('/products/{id}', Products\ProductLookupController::class);

        $this->app->get('/', function () {
            return Response::plaintext(
                "Hello trunk!\n"
            );
        });
    }

    public function run(){
        $this->app->run();
    }

}