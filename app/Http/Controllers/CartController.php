<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('menuItem')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id'
        ]);

        $cartItem = CartItem::where('user_id', Auth::user()->id)
            ->where('menu_item_id', $request->menu_item_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::user()->id,
                'menu_item_id' => $request->menu_item_id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Item added to cart successfully');
    }

    public function remove($id)
    {
        CartItem::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Item removed from cart successfully');
    }

    public function getCartCount()
    {
        return CartItem::where('user_id', Auth::user()->id)->sum('quantity');
    }
}
