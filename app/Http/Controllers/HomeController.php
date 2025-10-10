<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\ServiceService;
use Illuminate\Http\Request;

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

        return view('index', compact('services', 'products'));
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
