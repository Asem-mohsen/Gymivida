<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Starter Plan
        $starter = Product::create([
            'name' => 'Starter',
            'description' => 'Perfect for small gyms and fitness studios just getting started with digital management.',
            'monthly_price' => 299.00,
            'yearly_price' => 2999.00,
            'is_active' => true,
        ]);

        // Attach core features to Starter plan (features 1-5)
        $starterFeatures = Feature::where('is_core', true)->get();
        foreach ($starterFeatures as $index => $feature) {
            $starter->features()->attach($feature->id, ['order' => $index + 1]);
        }

        // Create Professional Plan
        $professional = Product::create([
            'name' => 'Professional',
            'description' => 'Comprehensive solution for growing gyms with multiple trainers and active member base.',
            'monthly_price' => 599.00,
            'yearly_price' => 5999.00,
            'is_active' => true,
        ]);

        // Attach features to Professional plan (core + some advanced features)
        $professionalFeatureIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
        foreach ($professionalFeatureIds as $index => $featureId) {
            $professional->features()->attach($featureId, ['order' => $index + 1]);
        }

        $enterprise = Product::create([
            'name' => 'Enterprise',
            'description' => 'Ultimate solution for large gym chains with multiple branches and advanced needs.',
            'monthly_price' => 1299.00,
            'yearly_price' => 12999.00,
            'is_active' => true,
        ]);

        // Attach all features to Enterprise plan
        $allFeatures = Feature::all();
        foreach ($allFeatures as $index => $feature) {
            $enterprise->features()->attach($feature->id, ['order' => $index + 1]);
        }
    }
}
