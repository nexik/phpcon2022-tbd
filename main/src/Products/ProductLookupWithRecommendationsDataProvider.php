<?php
namespace Tbd\Main\Products;

use Tbd\Main\Recommendations\RecommendationsServiceInterface;

class ProductLookupWithRecommendationsDataProvider implements ProductLookupDataProviderInterface
{
    private RecommendationsServiceInterface $service;

    public function __construct(RecommendationsServiceInterface $service)
    {
        $this->service = $service;
    }

    public function setService(RecommendationsServiceInterface $service)
    {
        $this->service = $service;
    }

    public function getData(Product $product): array
    {
        $recommendations = $this->service->getRecommendations($product->id);

        return [
            "name" => $product->title,
            "description" => $product->description,
            "price" => $product->price,
            "recommendations" => $recommendations
        ];
    }
}