<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Address;
use App\Models\Payment;
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

        $addresses = Address::where('user_id', Auth::id())->get();
        $defaultAddress = $addresses->where('is_default', true)->first();

        return view('checkout', compact('cartItems', 'total', 'addresses', 'defaultAddress'));
    }    public function store(Request $request)
    {
        $cartItems = CartItem::with('menuItem')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });

        // Get delivery info based on whether using saved address or new address
        if ($request->filled('address_id')) {
            $address = Address::where('user_id', Auth::id())
                ->findOrFail($request->address_id);
            $deliveryInfo = [
                'customer_name' => Auth::user()->name,
                'customer_email' => Auth::user()->email,
                'customer_phone' => $address->phone,
                'delivery_address' => $address->address
            ];
        } else {
            $deliveryInfo = [
                'customer_name' => $request->input('name'),
                'customer_email' => $request->input('email'),
                'customer_phone' => $request->input('phone'),
                'delivery_address' => $request->input('address')
            ];
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
            'customer_name' => $deliveryInfo['customer_name'],
            'customer_email' => $deliveryInfo['customer_email'],
            'customer_phone' => $deliveryInfo['customer_phone'],
            'delivery_address' => $deliveryInfo['delivery_address'],
            'order_number' => 'ORD-' . Str::random(10),
            'notes' => $request->input('notes'),
            'payment_method' => 'card',
            'payment_status' => 'pending'
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item->menuItem->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->menuItem->price,
                'subtotal' => $item->quantity * $item->menuItem->price,
                'special_instructions' => $item->special_instructions
            ]);
        }

        // Create payment record
        Payment::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'card_number' => str_repeat('*', strlen($request->input('card_number')) - 4) . substr($request->input('card_number'), -4),
            'card_holder_name' => $request->input('card_holder_name'),
            'expiration_month' => $request->input('expiration_month'),
            'expiration_year' => $request->input('expiration_year'),
            'amount' => $total,
            'status' => 'completed',
            'payment_method' => 'card'
        ]);

        // Clear the cart
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }
}
