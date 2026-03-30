@extends('admin.layouts.app')

@section('title', 'All Orders')
@section('header_title', 'Orders Management')
@section('header_subtitle', 'View and manage customer orders')

@section('content')
<div class="data-table">
    <div style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #EDE8EA;">
        <div class="font-serif-elegant text-xl font-bold" style="color:var(--text-dark);">All Orders</div>
        <div style="font-size:0.85em;color:var(--text-light);">{{ $orders->total() }} total orders</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Product Info (Total)</th>
                <th>Status & Routing</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="vertical-align:top;"><a href="#" style="font-weight:700;color:var(--primary);">#{{ $order->order_number }}</a></td>
                <td style="vertical-align:top;">
                    <div style="font-weight:600;">{{ optional($order->user)->name }}</div>
                    <div style="font-size:0.75rem;color:var(--text-light);">{{ $order->shipping_address }}</div>
                </td>
                <td style="vertical-align:top;">
                    <div style="font-weight:600;">${{ number_format($order->total_amount, 2) }}</div>
                    <div style="font-size:0.75rem;color:var(--text-light);">
                        @if($order->items->count() > 0)
                            {{ $order->items->first()->quantity }}x {{ optional($order->items->first()->product)->name }}
                        @else
                            No items
                        @endif
                    </div>
                </td>
                <td style="vertical-align:top;width:300px;">
                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}" style="display:flex;flex-direction:column;gap:8px;">
                        @csrf
                        <div style="display:flex;gap:8px;">
                            <select name="status" class="form-control" style="flex:1;padding:6px 10px;border-radius:6px;border:1px solid #e2e8f0;font-size:0.8rem;background:{{ $order->status == 'Delivered' ? '#E8F5E9' : ($order->status == 'Delayed' ? '#FFEBEE' : '#f8fafc') }};">
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Picked Up" {{ $order->status == 'Picked Up' ? 'selected' : '' }}>Picked Up</option>
                                <option value="On the Way" {{ $order->status == 'On the Way' ? 'selected' : '' }}>On the Way</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Delayed" {{ $order->status == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                                <option value="Not Delivered" {{ $order->status == 'Not Delivered' ? 'selected' : '' }}>Failed Delivery</option>
                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            
                            <select name="delivery_boy_id" class="form-control" style="flex:1;padding:6px 10px;border-radius:6px;border:1px solid #e2e8f0;font-size:0.8rem;">
                                <option value="">Assign Driver...</option>
                                @foreach($deliveryBoys as $boy)
                                    <option value="{{ $boy->id }}" {{ $order->delivery_boy_id == $boy->id ? 'selected' : '' }}>{{ $boy->name }}</option>
                                @endforeach
                            </select>
                            
                            <button type="submit" style="padding:6px 12px;border-radius:6px;background:var(--primary);color:white;font-size:0.75rem;font-weight:600;border:none;cursor:pointer;"><i class="fa-solid fa-check"></i></button>
                        </div>
                    </form>
                </td>
                <td style="vertical-align:top;">
                    @if($order->delivery_notes)
                        <div style="font-size:0.75rem;color:#ef4444;background:#fef2f2;padding:6px 10px;border-radius:6px;border:1px solid #fecaca;">
                            <strong>Note:</strong> {{ $order->delivery_notes }}
                        </div>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding:40px; color:var(--text-light);">
                    <i class="fa-solid fa-bag-shopping text-3xl mb-3" style="color:#C4B8BC;display:block;"></i>
                    No orders found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($orders->hasPages())
    <div style="padding:15px 24px; border-top:1px solid #EDE8EA;">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
