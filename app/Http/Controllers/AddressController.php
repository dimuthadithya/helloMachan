<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->latest()->get();
        return view('addresses.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'is_default' => 'boolean'
        ]);

        if ($request->is_default) {
            // Remove default status from other addresses
            Address::where('user_id', Auth::id())
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'phone' => $request->phone,
            'is_default' => $request->is_default ?? false
        ]);

        return back()->with('success', 'Address added successfully');
    }

    public function update(Address $address, Request $request)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'is_default' => 'boolean'
        ]);

        if ($request->is_default) {
            // Remove default status from other addresses
            Address::where('user_id', Auth::id())
                ->where('id', '!=', $address->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        $address->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'is_default' => $request->is_default ?? false
        ]);

        return back()->with('success', 'Address updated successfully');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();
        return back()->with('success', 'Address deleted successfully');
    }
}
