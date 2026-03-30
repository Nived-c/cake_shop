<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'deliveryBoy'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $deliveryBoys = \App\Models\User::where('role', 'delivery_boy')->get();
            
        return view('admin.orders.index', compact('orders', 'deliveryBoys'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required',
            'delivery_boy_id' => 'nullable|exists:users,id'
        ]);

        $order->status = $request->status;
        if($request->has('delivery_boy_id')){
            $order->delivery_boy_id = $request->delivery_boy_id;
        }
        $order->save();

        return back()->with('success', 'Order updated successfully.');
    }
}
