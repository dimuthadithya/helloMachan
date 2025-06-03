<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {        // Get all completed orders that don't have feedback yet
        $completedOrders = Order::where('status', 'completed')
            ->whereNotNull('completed_at')
            ->whereDoesntHave('feedback')
            ->latest()
            ->take(6)
            ->get();

        $testimonials = [
            [
                'rating' => 5,
                'comment' => 'The food was absolutely delicious! Everything was fresh and flavorful. The service was quick and efficient. Will definitely order again!',
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'rating' => 4,
                'comment' => 'Great menu selection and reasonable prices. The portions were generous and the quality was excellent.',
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'rating' => 5,
                'comment' => 'Outstanding experience! The food arrived hot and exactly as ordered. The packaging was eco-friendly too!',
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'rating' => 4,
                'comment' => 'Really enjoyed my meal. The flavors were authentic and the delivery was prompt.',
                'is_approved' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'comment' => 'Best restaurant in town! The quality is consistently excellent and the staff is very professional.',
                'is_approved' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 3,
                'comment' => 'Good food but delivery took a bit longer than expected. Still worth the wait though.',
                'is_approved' => false,
                'is_featured' => false,
            ],
        ];

        foreach ($completedOrders as $index => $order) {
            if (isset($testimonials[$index])) {
                Feedback::create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'rating' => $testimonials[$index]['rating'],
                    'comment' => $testimonials[$index]['comment'],
                    'is_approved' => $testimonials[$index]['is_approved'],
                    'is_featured' => $testimonials[$index]['is_featured'],
                    'created_at' => $order->completed_at ?? $order->updated_at,
                ]);
            }
        }
    }
}
