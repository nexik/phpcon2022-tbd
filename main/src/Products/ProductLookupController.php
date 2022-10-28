<?php

namespace Tbd\Main\Products;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

class ProductLookupController
{
    private $repository;
    private $provider;

    public function __construct(ProductRepositoryInterface $repository, ProductLookupStandardDataProvider $provider)
    {
        $this->repository = $repository;
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');
        $product = $this->repository->findProduct($id);

        if ($product === null) {
            return Response::plaintext(
                "Product not found\n"
            )->withStatus(Response::STATUS_NOT_FOUND);
        }
        $data = $this->provider->getData($product);

        return Response::json($data);
    }
}