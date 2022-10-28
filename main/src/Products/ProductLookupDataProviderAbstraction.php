<?php
namespace Tbd\Main\Products;

use Tbd\Main\FeatureFlags\FeatureFlag;
use Tbd\Main\Recommendations\RecommendationsService;

class ProductLookupDataProviderAbstraction implements ProductLookupDataProviderInterface
{
    private $implementation;

    public function __construct()
    {
        if (FeatureFlag::isEnabled('show_recommendations_on_product_lookup')) {
            $this->implementation = new ProductLookupWithRecommendationsDataProvider(
                new RecommendationsService(getenv('RECOMMENDATIONS_SERVICE_URL'))
            );
        } else {
            $this->implementation = new ProductLookupStandardDataProvider();
        }
    }

    public function getImplementation(): ProductLookupDataProviderInterface
    {
        return $this->implementation;
    }

    public function getData(Product $product): array
    {
        return $this->implementation->getData($product);
    }
}