<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all customers (non-admin users)
        $customers = User::where('role', 'customer')->get();

        // Sample addresses
        $addresses = [
            [
                'address' => '123 Main Street, Colombo 03',
                'phone' => '0771234567'
            ],
            [
                'address' => '456 Temple Road, Kandy',
                'phone' => '0772345678'
            ],
            [
                'address' => '789 Marine Drive, Mount Lavinia',
                'phone' => '0773456789'
            ],
            [
                'address' => '321 Hill Street, Nuwara Eliya',
                'phone' => '0774567890'
            ],
            [
                'address' => '654 Beach Road, Galle',
                'phone' => '0775678901'
            ],
            [
                'address' => '987 Lake Drive, Batticaloa',
                'phone' => '0776789012'
            ],
            [
                'address' => '147 Station Road, Jaffna',
                'phone' => '0777890123'
            ],
            [
                'address' => '258 Palm Grove, Negombo',
                'phone' => '0778901234'
            ]
        ];

        // Create 1-3 addresses for each customer
        foreach ($customers as $customer) {
            // Randomly select 1-3 addresses for this customer
            $numAddresses = rand(1, 3);
            $customerAddresses = collect($addresses)->random($numAddresses);
            
            foreach ($customerAddresses as $index => $addressData) {
                // Create the address
                Address::create([
                    'user_id' => $customer->id,
                    'address' => $addressData['address'],
                    'phone' => $addressData['phone'],
                    'is_default' => $index === 0 // First address is set as default
                ]);
            }
        }
    }
}
