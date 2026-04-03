<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminDeliveryController extends Controller
{
    public function index()
    {
        // Get orders that are for delivery (Pending, Processing, Delivered)
        $deliveries = Order::with(['user', 'items.product'])
            ->orderBy('delivery_date', 'asc')
            ->paginate(15);
            
        return view('admin.deliveries.index', compact('deliveries'));
    }
}
