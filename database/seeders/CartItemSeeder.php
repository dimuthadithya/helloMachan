<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'customer')->take(3)->get();
        $menuItems = MenuItem::all();

        foreach ($users as $user) {
            // Add 1-3 items to each user's cart
            $cartItemsCount = rand(1, 3);
            $items = $menuItems->random($cartItemsCount);

            foreach ($items as $item) {
                CartItem::create([
                    'user_id' => $user->id,
                    'menu_item_id' => $item->id,
                    'quantity' => rand(1, 2),
                    'special_instructions' => rand(0, 1) ? 'No onions' : null
                ]);
            }
        }
    }
}
