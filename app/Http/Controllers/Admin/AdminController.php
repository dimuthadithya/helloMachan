<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $statistics = [
            'orders' => Order::count(),
            'menu_items' => MenuItem::count(),
            'categories' => Category::count(),
            'users' => User::count()
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('statistics', 'recent_orders'));
    }
}
