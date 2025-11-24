<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService,
        protected ProductService $productService
    ) {
        $this->serviceService = $serviceService;
        $this->productService = $productService;
    }

    public function index()
    {
        $cacheTtl = now()->addMinutes(config('app.home_page_cache_ttl', 10));

        $homeData = Cache::remember('home_page_data', $cacheTtl, function () {
            $services = $this->serviceService->getActiveServices();
            $products = $this->productService->getActiveProductsWithFeatures();
            $comparisonFeatures = $this->productService->getComparisonFeatures($products);
            $averageDiscount = $this->calculateAverageDiscount($products);

            return compact('services', 'products', 'comparisonFeatures', 'averageDiscount');
        });

        return view('index', $homeData);
    }
    
    private function calculateAverageDiscount($products)
    {
        if ($products->isEmpty()) {
            return 0;
        }
        
        $totalDiscount = 0;
        $validProducts = 0;
        
        foreach ($products as $product) {
            if ($product->monthly_price > 0 && $product->yearly_price > 0) {
                $monthlyTotal = $product->monthly_price * 12;
                $yearlyPrice = $product->yearly_price;
                
                if ($monthlyTotal > $yearlyPrice) {
                    $discount = (($monthlyTotal - $yearlyPrice) / $monthlyTotal) * 100;
                    $totalDiscount += $discount;
                    $validProducts++;
                }
            }
        }
        
        return $validProducts > 0 ? round($totalDiscount / $validProducts) : 0;
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function serviceDetails()
    {
        return view('service-details');
    }
    
    public function portfolioDetails()
    {
        return view('portfolio-details');
    }
}
