<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rice & Curry',
                'description' => 'Traditional Sri Lankan rice and curry dishes',
                'image' => 'categories/rice-curry.jpg'
            ],
            [
                'name' => 'Kottu',
                'description' => 'Variety of kottu dishes',
                'image' => 'categories/kottu.jpg'
            ],
            [
                'name' => 'Noodles',
                'description' => 'Chinese and local style noodle dishes',
                'image' => 'categories/noodles.jpg'
            ],
            [
                'name' => 'Short Eats',
                'description' => 'Quick snacks and short eats',
                'image' => 'categories/short-eats.jpg'
            ],
            [
                'name' => 'Beverages',
                'description' => 'Soft drinks and fresh juices',
                'image' => 'categories/beverages.jpg'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => $category['image'],
                'is_active' => true
            ]);
        }
    }
}
