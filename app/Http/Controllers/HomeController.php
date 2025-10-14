<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\ServiceService;

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
        $services = $this->serviceService->getActiveServices();
        $products = $this->productService->getActiveProductsWithFeatures();
        
        $averageDiscount = $this->calculateAverageDiscount($products);

        return view('index', compact('services', 'products', 'averageDiscount'));
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
