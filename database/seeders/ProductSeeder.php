<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $starter = Product::create([
            'name' => 'Starter',
            'description' => 'Perfect for small gyms and fitness studios just getting started with digital management.',
            'monthly_price' => 3000.00,
            'yearly_price' => 30000.00,
            'trial_period_days' => 30,
            'is_active' => true,
        ]);

        $starterFeatures = Feature::where('is_core', true)->get();
        foreach ($starterFeatures as $index => $feature) {
            $limit = null;
            
            if ($feature->key === 'multi_branch_management') {
                $limit = 2;
            }
            
            $starter->features()->attach($feature->id, [
                'order' => $index + 1,
                'limit' => $limit
            ]);
        }

        // Create Professional Plan
        $professional = Product::create([
            'name' => 'Professional',
            'description' => 'Comprehensive solution for growing gyms with multiple trainers and active member base.',
            'monthly_price' => 5000.00,
            'yearly_price' => 50000.00,
            'trial_period_days' => 30,
            'is_active' => true,
        ]);

        $professionalFeatureIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
        foreach ($professionalFeatureIds as $index => $featureId) {
            $feature = Feature::find($featureId);
            $limit = null;
            
            if ($feature && $feature->key === 'multi_branch_management') {
                $limit = 6;
            }
            
            $professional->features()->attach($featureId, [
                'order' => $index + 1,
                'limit' => $limit
            ]);
        }

        $enterprise = Product::create([
            'name' => 'Enterprise',
            'description' => 'Ultimate solution for large gym chains with multiple branches and advanced needs.',
            'monthly_price' => 9000.00,
            'yearly_price' => 90000.00,
            'trial_period_days' => 30,
            'is_active' => true,
        ]);

        $allFeatures = Feature::all();
        foreach ($allFeatures as $index => $feature) {
            $limit = null;
            
            $enterprise->features()->attach($feature->id, [
                'order' => $index + 1,
                'limit' => $limit
            ]);
        }
    }
}
