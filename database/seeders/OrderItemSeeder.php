<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $menuItems = MenuItem::all();

        foreach ($orders as $order) {
            // Add 2-3 items per order
            $orderItemsCount = rand(2, 3);
            $items = $menuItems->random($orderItemsCount);

            foreach ($items as $item) {
                $quantity = rand(1, 3);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item->id,
                    'quantity' => $quantity,
                    'unit_price' => $item->price,
                    'subtotal' => $item->price * $quantity,
                    'special_instructions' => rand(0, 1) ? 'Extra spicy' : null
                ]);
            }
        }
    }
}
