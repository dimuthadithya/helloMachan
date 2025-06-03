<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some customers if none exist
        if (User::where('role', 'customer')->count() === 0) {
            User::create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
                'role' => 'customer',
                'email_verified_at' => now()
            ]);

            User::create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
                'role' => 'customer',
                'email_verified_at' => now()
            ]);
        }

        // Get all customers (non-admin users)
        $customers = User::where('role', 'customer')->get();

        // Get all menu items
        $menuItems = MenuItem::all();

        // Sample addresses
        $addresses = [
            '123 Main St, Colombo 03',
            '456 Church Road, Negombo',
            '789 Beach Road, Mount Lavinia',
            '321 Temple Road, Kandy',
            '654 Lake Drive, Nuwara Eliya',
            '987 Palm Grove, Galle'
        ];

        // Sample special instructions
        $specialInstructions = [
            'Extra spicy please',
            'No onions',
            'Please deliver before 8 PM',
            'Ring the doorbell twice',
            'Extra napkins please',
            'Please add extra sauce',
            null
        ];

        // Create 20 orders with random data
        for ($i = 0; $i < 20; $i++) {
            // Random customer
            $customer = $customers->random();

            // Random date within last 30 days
            $date = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 24));

            // Random status with bias towards completed
            $status = collect(['pending', 'processing', 'completed', 'completed', 'completed', 'cancelled'])->random();

            // Create order
            $order = Order::create([
                'user_id' => $customer->id,
                'status' => $status,
                'total_amount' => 0, // Will be calculated after adding items
                'payment_status' => $status === 'completed' ? 'paid' : 'pending',
                'payment_method' => collect(['cash', 'card'])->random(),
                'delivery_address' => collect($addresses)->random(),
                'contact_number' => '077' . rand(1000000, 9999999),
                'special_instructions' => collect($specialInstructions)->random(),
                'completed_at' => $status === 'completed' ? $date->addHours(rand(1, 3)) : null,
                'created_at' => $date,
                'updated_at' => $status === 'pending' ? $date : $date->addHours(rand(1, 48))
            ]);

            // Add 1-5 random items to the order
            $orderTotal = 0;
            $numItems = rand(1, 5);

            // Get random menu items ensuring no duplicates
            $orderItems = $menuItems->random($numItems);

            foreach ($orderItems as $menuItem) {
                $quantity = rand(1, 3);
                $unitPrice = $menuItem->price;
                $subtotal = $unitPrice * $quantity;
                $orderTotal += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                    'special_instructions' => collect([
                        'Extra spicy',
                        'No onions',
                        'Extra sauce',
                        null
                    ])->random(),
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
            }

            // Update order total
            $order->update(['total_amount' => $orderTotal]);
        }
    }
}
