<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 55 Subs seeders
        $numberOfSubscriptions = 65;

        // Seed subscriptions
        for ($i = 1; $i <= $numberOfSubscriptions; $i++) {
            Subscription::create([
                'title' => "Subscription $i",
                'description' => "Description for Subscription $i",
                'image' => 'images/Logo.png', // Normal Logo placeholder Image
                'price' => rand(45, 100), // Random pricing
            ]);
        }
    }
}
