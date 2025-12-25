<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
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
            $demoDocumentation = Documentation::getByType('documentation');
            $registrationDemo = Documentation::getByType('registration');
            return compact('services', 'products', 'comparisonFeatures', 'averageDiscount', 'demoDocumentation', 'registrationDemo');
        });

        // Ensure documentation variables exist (fallback for old cache)
        if (!isset($homeData['demoDocumentation'])) {
            $homeData['demoDocumentation'] = Documentation::getByType('documentation');
        }
        if (!isset($homeData['registrationDemo'])) {
            $homeData['registrationDemo'] = Documentation::getByType('registration');
        }

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

    public function downloadDocumentation($type)
    {
        $documentation = \App\Models\Documentation::getByType($type);
        
        if (!$documentation || !$documentation->file_path) {
            abort(404, 'Documentation not found');
        }

        $filePath = storage_path('app/public/' . $documentation->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $fileName = $documentation->file_name ?: basename($documentation->file_path);
        
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
