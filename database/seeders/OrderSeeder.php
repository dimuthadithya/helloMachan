<?php

namespace Database\Seeders;

use App\Models\Order;
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
        $users = User::where('role', 'customer')->take(3)->get();

        $orders = [
            [
                'total_amount' => 1100.00,
                'status' => 'completed',
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'delivery_address' => '123 Main St, Colombo',
                'contact_number' => '0771234567',
                'special_instructions' => 'Extra spicy please',
                'completed_at' => Carbon::now()->subHours(2)
            ],
            [
                'total_amount' => 850.00,
                'status' => 'processing',
                'payment_status' => 'pending',
                'payment_method' => 'card',
                'delivery_address' => '456 Church Road, Negombo',
                'contact_number' => '0777654321',
                'special_instructions' => 'No onions',
                'completed_at' => null
            ],
            [
                'total_amount' => 1500.00,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cash',
                'delivery_address' => '789 Beach Road, Mount Lavinia',
                'contact_number' => '0759876543',
                'special_instructions' => 'Please deliver before 8 PM',
                'completed_at' => null
            ]
        ];

        foreach ($users as $index => $user) {
            Order::create([
                'user_id' => $user->id,
                ...$orders[$index]
            ]);
        }
    }
}
