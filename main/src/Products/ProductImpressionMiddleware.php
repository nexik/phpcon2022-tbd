<?php
namespace Tbd\Main\Products;

use Psr\Http\Message\ServerRequestInterface;
use Tbd\Main\Recommendations\RecommendationsServiceInterface;

class ProductImpressionMiddleware
{
    private RecommendationsServiceInterface $service;

    public function __construct(RecommendationsServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        return $next($request);
    }
}
