<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('menuItems')->get();
        $items = MenuItem::with('category')
            ->where('is_available', true)
            ->orderBy('category_id')
            ->get();

        return view('menu', compact('categories', 'items'));
    }
}
