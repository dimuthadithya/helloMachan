<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
            AddressSeeder::class, // Add addresses before orders
            OrderSeeder::class,
            OrderItemSeeder::class,
            CartItemSeeder::class,
            FeedbackSeeder::class, // Add feedback after orders
        ]);
    }
}
