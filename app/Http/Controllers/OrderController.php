<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.menuItem'])
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order'));
    }
}
