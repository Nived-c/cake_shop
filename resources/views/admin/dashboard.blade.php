@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<!-- Stat Cards -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:32px;">

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon">
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <span style="font-size:0.75rem;font-weight:600;color:var(--primary);background:rgba(178,145,95,0.1);padding:4px 10px;border-radius:50px;">Overall</span>
        </div>
        <div style="font-size:2rem;font-weight:700;color:var(--text-dark);line-height:1;">{{ $totalDeliveries }}</div>
        <div style="font-size:0.82rem;color:var(--text-light);margin-top:4px;">Total Deliveries</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon">
                <i class="fa-solid fa-clock" style="color:#E8A000 !important;"></i>
            </div>
            <span style="font-size:0.75rem;font-weight:600;color:#E8A000;background:rgba(232,160,0,0.1);padding:4px 10px;border-radius:50px;">Live</span>
        </div>
        <div style="font-size:2rem;font-weight:700;color:var(--text-dark);line-height:1;">{{ $pendingDeliveries }}</div>
        <div style="font-size:0.82rem;color:var(--text-light);margin-top:4px;">Pending Deliveries</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon">
                <i class="fa-solid fa-circle-check" style="color:#4CAF50 !important;"></i>
            </div>
            <span style="font-size:0.75rem;font-weight:600;color:#4CAF50;background:rgba(76,175,80,0.1);padding:4px 10px;border-radius:50px;">Done</span>
        </div>
        <div style="font-size:2rem;font-weight:700;color:var(--text-dark);line-height:1;">{{ $completedDeliveries }}</div>
        <div style="font-size:0.82rem;color:var(--text-light);margin-top:4px;">Completed</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon">
                <i class="fa-solid fa-bag-shopping" style="color:#5C6BC0 !important;"></i>
            </div>
            <span style="font-size:0.75rem;font-weight:600;color:#5C6BC0;background:rgba(92,107,192,0.1);padding:4px 10px;border-radius:50px;">Today</span>
        </div>
        <div style="font-size:2rem;font-weight:700;color:var(--text-dark);line-height:1;">{{ $newOrdersToday }}</div>
        <div style="font-size:0.82rem;color:var(--text-light);margin-top:4px;">New Orders</div>
    </div>
</div>

<!-- Recent Deliveries Table -->
<div class="data-table">
    <div style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="font-serif-elegant text-xl font-bold" style="color:var(--primary);">Recent Orders</div>
        <a href="{{ route('admin.orders.index') }}" style="font-size:0.82rem;font-weight:600;color:var(--primary);">View All <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentOrders as $order)
            <tr>
                <td><a href="#" style="font-weight:700;color:var(--primary);">#{{ $order->order_number }}</a></td>
                <td>
                    <div style="font-weight:600;">{{ optional($order->user)->name }}</div>
                </td>
                <td>
                    @if($order->items->count() > 0)
                        {{ optional($order->items->first()->product)->name }}
                        @if($order->items->count() > 1)
                            <span style="font-size:0.75rem;color:var(--text-light);">+{{ $order->items->count() - 1 }} more</span>
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td>
                    <div style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $order->shipping_address }}">
                        <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> {{ $order->shipping_address }}
                    </div>
                </td>
                <td>
                    @if($order->status === 'Pending')
                        <span class="badge badge-pending"><i class="fa-solid fa-circle text-xs"></i> Pending</span>
                    @elseif($order->status === 'Processing')
                        <span class="badge badge-processing"><i class="fa-solid fa-circle text-xs"></i> Processing</span>
                    @elseif($order->status === 'Delivered')
                        <span class="badge badge-delivered"><i class="fa-solid fa-circle text-xs"></i> Delivered</span>
                    @else
                        <span class="badge badge-cancelled"><i class="fa-solid fa-circle text-xs"></i> {{ $order->status }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding:40px; color:var(--text-light);">
                    <i class="fa-solid fa-basket-shopping text-3xl mb-3" style="color:#C4B8BC;display:block;"></i>
                    No recent orders found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
