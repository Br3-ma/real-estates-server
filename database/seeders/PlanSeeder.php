<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\PlanFeature;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::create([
            'name' => 'Basic Plan',
            'description' => 'This plan offers essential features for small businesses.',
            'duration' => 1,
            'duration_type' => 'month', // Options: month, year, etc.
            'amount' => 19.99,
            'discount' => 0,
        ]);
        PlanFeature::create([
            'name' => 'Up to 5',
            'plan_id' => $plan->id,
        ]);
        PlanFeature::create([
            'name' => '10 GB',
            'plan_id' => $plan->id,
        ]);
        PlanFeature::create([
            'name' => '1,000/month',
            'plan_id' => $plan->id,
        ]);
        PlanFeature::create([
            'name' => 'Weekly',
            'plan_id' => $plan->id,
        ]);



        $plan2 = Plan::create([
            'name' => 'Standard Plan',
            'description' => 'Perfect for growing businesses with additional features.',
            'duration' => 6,
            'duration_type' => 'month',
            'amount' => 99.99,
            'discount' => 10, // percentage discount
        ]);
        PlanFeature::create([
            'name' => 'Up to 15',
            'plan_id' => $plan2->id,
        ]);
        PlanFeature::create([
            'name' => '30 GB',
            'plan_id' => $plan2->id,
        ]);
    

        $plan3 = Plan::create([
            'name' => 'Premium Plan',
            'description' => 'The best option for large businesses with full features access.',
            'duration' => 12,
            'duration_type' => 'month',
            'amount' => 199.99,
            'discount' => 15, // percentage discount
        ]);
        PlanFeature::create([
            'name' => 'Up to 25',
            'plan_id' => $plan3->id,
        ]);
        PlanFeature::create([
            'name' => '100 GB',
            'plan_id' => $plan3->id,
        ]);
        PlanFeature::create([
            'name' => '1,000/month',
            'plan_id' => $plan3->id,
        ]);
    }
}
