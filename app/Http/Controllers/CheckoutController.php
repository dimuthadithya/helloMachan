<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Address;
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
    }
    public function store(Request $request)
    {
        $cartItems = CartItem::with('menuItem')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'notes' => 'nullable|string'
        ];

        // If not using a saved address, require address and phone
        if (!$request->filled('address_id')) {
            $rules['address'] = 'required|string';
            $rules['phone'] = 'required|string|max:20';
        } else {
            $rules['address_id'] = 'required|exists:addresses,id,user_id,' . Auth::id();
        }

        $request->validate($rules);        // Get the delivery information
        $deliveryInfo = [];
        if ($request->filled('address_id')) {
            $address = Address::where('user_id', Auth::id())
                ->findOrFail($request->address_id);
            $deliveryInfo = [
                'delivery_address' => $address->address,
                'customer_phone' => $address->phone
            ];
        } else {
            $deliveryInfo = [
                'delivery_address' => $request->address,
                'customer_phone' => $request->phone
            ];
        }

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
            'customer_phone' => $deliveryInfo['customer_phone'],
            'delivery_address' => $deliveryInfo['delivery_address'],
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
