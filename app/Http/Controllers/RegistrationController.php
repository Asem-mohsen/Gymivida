<?php

namespace App\Http\Controllers;

use App\Services\GymRegistrationService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RuntimeException;

class RegistrationController extends Controller
{
    public function __construct(
        protected GymRegistrationService $registrationService,
    ) {}

    public function show(Request $request, string $locale): View
    {
        $planContext = $this->registrationService->resolvePlanFromQuery(
            $request->query('plan'),
            $request->query('billing')
        );

        $registration = null;
        $error = null;

        try {
            if ($request->filled('token')) {
                $result = $this->registrationService->resume((string) $request->query('token'));
                $registration = $result['data'] ?? null;
            } else {
                $current = $this->registrationService->showCurrent();
                $registration = $current['data'] ?? null;
            }
        } catch (RuntimeException $e) {
            $error = $e->getMessage();
        }

        $products = $planContext['products']->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->getTranslation('name', app()->getLocale()),
                'name_en' => $product->getTranslation('name', 'en'),
                'slug' => str($product->getTranslation('name', 'en'))->lower()->replace(' ', '-')->toString(),
                'monthly_price' => (float) $product->monthly_price,
                'yearly_price' => (float) $product->yearly_price,
                'currency' => $product->currency ?? 'EGP',
                'trial_period_days' => (int) $product->trial_period_days,
            ];
        })->values();

        return view('registration.form', [
            'products' => $products,
            'selectedPlanId' => $registration['external_plan_id'] ?? $planContext['selected_plan_id'],
            'billingCycle' => $registration['billing_cycle'] ?? $planContext['billing_cycle'],
            'registration' => $registration,
            'bootstrapError' => $error,
            'locale' => $locale,
        ]);
    }

    public function success(string $locale): View
    {
        return view('registration.success', [
            'locale' => $locale,
        ]);
    }
}
