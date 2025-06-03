<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        // Get query parameters
        $category = request('category');
        $status = request('status');

        // Start query builder
        $query = MenuItem::with('category')->latest();

        // Apply filters
        if ($category) {
            $query->where('category_id', $category);
        }

        if ($status !== null) {
            $query->where('is_available', $status);
        }

        // Get paginated results
        $items = $query->paginate(10);

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu', 'public');
        }

        MenuItem::create($data);

        return redirect()->route('admin.items.index')->with('success', 'Menu item created successfully');
    }    public function edit(MenuItem $item)
    {
        $categories = \App\Models\Category::all();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, MenuItem $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::delete('public/' . $item->image);
            }
            $data['image'] = $request->file('image')->store('menu', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.items.index')->with('success', 'Menu item updated successfully');
    }

    public function destroy(MenuItem $item)
    {
        if ($item->image) {
            Storage::delete('public/' . $item->image);
        }

        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Menu item deleted successfully');
    }
}
