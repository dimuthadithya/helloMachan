<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $riceCategory = Category::where('name', 'Rice & Curry')->first();
        $kottuCategory = Category::where('name', 'Kottu')->first();
        $noodlesCategory = Category::where('name', 'Noodles')->first();
        $shortEatsCategory = Category::where('name', 'Short Eats')->first();
        $beveragesCategory = Category::where('name', 'Beverages')->first();

        $menuItems = [
            // Rice & Curry Items
            [
                'category_id' => $riceCategory->id,
                'name' => 'Chicken Rice & Curry',
                'description' => 'Rice with chicken curry, three vegetables, and papadam',
                'price' => 450.00,
                'image' => 'menu/chicken-rice.jpg',
                'preparation_time' => 15
            ],
            [
                'category_id' => $riceCategory->id,
                'name' => 'Fish Rice & Curry',
                'description' => 'Rice with fish curry, three vegetables, and papadam',
                'price' => 400.00,
                'image' => 'menu/fish-rice.jpg',
                'preparation_time' => 15
            ],
            // Kottu Items
            [
                'category_id' => $kottuCategory->id,
                'name' => 'Chicken Cheese Kottu',
                'description' => 'Spicy kottu with chicken and cheese',
                'price' => 650.00,
                'image' => 'menu/chicken-cheese-kottu.jpg',
                'preparation_time' => 20
            ],
            [
                'category_id' => $kottuCategory->id,
                'name' => 'Vegetable Kottu',
                'description' => 'Kottu with mixed vegetables',
                'price' => 400.00,
                'image' => 'menu/veg-kottu.jpg',
                'preparation_time' => 15
            ],
            // Noodles Items
            [
                'category_id' => $noodlesCategory->id,
                'name' => 'Mixed Noodles',
                'description' => 'Noodles with chicken, egg, and vegetables',
                'price' => 500.00,
                'image' => 'menu/mixed-noodles.jpg',
                'preparation_time' => 15
            ],
            // Short Eats
            [
                'category_id' => $shortEatsCategory->id,
                'name' => 'Fish Bun',
                'description' => 'Fresh baked bun with spicy fish filling',
                'price' => 100.00,
                'image' => 'menu/fish-bun.jpg',
                'preparation_time' => 5
            ],
            // Beverages
            [
                'category_id' => $beveragesCategory->id,
                'name' => 'Faluda',
                'description' => 'Traditional faluda with ice cream',
                'price' => 250.00,
                'image' => 'menu/faluda.jpg',
                'preparation_time' => 10
            ]
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'price' => $item['price'],
                'image' => $item['image'],
                'is_available' => true,
                'preparation_time' => $item['preparation_time']
            ]);
        }
    }
}
