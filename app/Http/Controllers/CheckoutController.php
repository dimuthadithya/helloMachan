<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('menuItem')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cartItems = CartItem::with('menuItem')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_number' => 'ORD-' . Str::random(10),
            'status' => 'pending',
            'total_amount' => $cartItems->sum(function ($item) {
                return $item->quantity * $item->menuItem->price;
            }),
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'delivery_address' => $request->address,
            'notes' => $request->notes
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $cartItem->menu_item_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->menuItem->price,
                'subtotal' => $cartItem->quantity * $cartItem->menuItem->price
            ]);
        }

        // Clear the cart
        CartItem::query()->where('user_id', Auth::user()->id)->delete();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully! Your order number is ' . $order->order_number);
    }
}
