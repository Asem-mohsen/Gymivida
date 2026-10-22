<?php

namespace App\Http\Controllers;

use App\Enums\FaqKind;
use App\Models\Documentation;
use App\Services\DocumentationService;
use App\Services\FaqService;
use App\Services\ProductService;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService,
        protected ProductService $productService,
        protected FaqService $faqService,
        protected DocumentationService $documentationService,
    ) {}

    public function index()
    {
        $locale = app()->getLocale();
        $cacheTtl = now()->addMinutes(config('app.home_page_cache_ttl', 10));
        $cacheKey = 'home_page_data_' . $locale;

        $homeData = Cache::remember($cacheKey, $cacheTtl, function () use ($locale) {
            $services = $this->serviceService->getActiveServices();
            $products = $this->productService->getActiveProductsWithFeatures();
            $comparisonFeatures = $this->productService->getComparisonFeatures($products);
            $averageDiscount = $this->calculateAverageDiscount($products);
            $faqs = $this->faqService->getOrdered();
            $demoDocumentation = Documentation::getByType('documentation', $locale);
            $registrationDemo = Documentation::getByType('registration', $locale);

            return compact('services', 'products', 'comparisonFeatures', 'averageDiscount', 'faqs', 'demoDocumentation', 'registrationDemo');
        });

        // Ensure documentation variables exist (fallback for old cache)
        if (!isset($homeData['demoDocumentation'])) {
            $homeData['demoDocumentation'] = Documentation::getByType('documentation', $locale);
        }
        if (!isset($homeData['registrationDemo'])) {
            $homeData['registrationDemo'] = Documentation::getByType('registration', $locale);
        }
        if (!isset($homeData['faqs'])) {
            $homeData['faqs'] = $this->faqService->getOrdered();
        }

        $allFaqs = $homeData['faqs'];
        $freeTrialFaq = $allFaqs->first(fn ($faq) => $faq->kind === FaqKind::FreeTrial);
        $otherFaqs = $allFaqs->filter(fn ($faq) => $faq->kind !== FaqKind::FreeTrial)->values();
        $homeData['faqsHomePreview'] = $otherFaqs
            ->take(3)
            ->when($freeTrialFaq, fn ($c) => $c->push($freeTrialFaq))
            ->take(4);

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

    public function faqs()
    {
        $locale = app()->getLocale();
        $cacheTtl = now()->addMinutes(config('app.home_page_cache_ttl', 10));
        $cacheKey = 'faqs_page_data_' . $locale;

        $data = Cache::remember($cacheKey, $cacheTtl, function () {
            return [
                'faqs' => $this->faqService->getOrdered(),
                'products' => $this->productService->getActiveProductsWithFeatures(),
            ];
        });

        return view('faqs', $data);
    }

    public function serviceDetails()
    {
        return view('service-details');
    }

    public function portfolioDetails()
    {
        return view('portfolio-details');
    }

    public function downloadDocumentation(Request $request, string $type): BinaryFileResponse|Response
    {
        // Prefer explicit ?locale= from localized page links; missing/invalid → English
        $locale = $request->query('locale');

        return $this->documentationService->download(
            $type,
            is_string($locale) ? $locale : null,
        );
    }
}
