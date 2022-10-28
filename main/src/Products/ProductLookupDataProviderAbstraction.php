<?php
namespace Tbd\Main\Products;

use Tbd\Main\FeatureFlags\FeatureFlag;

class ProductLookupDataProviderAbstraction implements ProductLookupDataProviderInterface
{
    private $implementation;

    public function __construct()
    {
        if (false === FeatureFlag::isEnabled('show_recommendations_on_product_lookup')) {
            $this->implementation = new ProductLookupStandardDataProvider();
        }
    }

    public function getData(Product $product): array
    {
        return $this->implementation->getData($product);
    }
}