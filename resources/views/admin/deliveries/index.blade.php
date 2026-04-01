@extends('admin.layouts.app')

@section('title', 'Active Deliveries')
@section('header_title', 'Delivery Tracking')
@section('header_subtitle', 'Monitor active and pending deliveries in real-time')

@section('content')
<div class="data-table">
    <div style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="font-serif-elegant text-xl font-bold" style="color:var(--primary);">Current Deliveries</div>
        <div style="font-size:0.85em;color:var(--text-light);">{{ $deliveries->total() }} total tracking</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Driver</th>
                <th>Customer & Location</th>
                <th>Status</th>
                <th>Notes/Delays</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deliveries as $order)
            <tr>
                <td style="vertical-align:top;"><a href="#" style="font-weight:700;color:var(--primary);">#{{ $order->order_number }}</a></td>
                <td style="vertical-align:top;">
                    @if($order->deliveryBoy)
                        <div style="font-weight:600;"><i class="fa-solid fa-motorcycle text-gray-400 mr-1 text-xs"></i> {{ $order->deliveryBoy->name }}</div>
                    @else
                        <span style="font-size:0.75rem;color:var(--text-light);background:rgba(255,255,255,0.05);padding:4px 8px;border-radius:4px;">Unassigned</span>
                    @endif
                </td>
                <td style="vertical-align:top;">
                    <div style="font-weight:600;">{{ optional($order->user)->name }}</div>
                    <div style="font-size:0.75rem;color:var(--text-light);">
                        <i class="fa-solid fa-location-dot text-gray-300 mr-1"></i> {{ $order->shipping_address }}
                    </div>
                </td>
                <td style="vertical-align:top;">
                    @if($order->status === 'Pending')
                        <span class="badge badge-pending"><i class="fa-solid fa-circle text-xs"></i> Pending</span>
                    @elseif($order->status === 'Processing')
                        <span class="badge badge-processing"><i class="fa-solid fa-circle text-xs"></i> Processing</span>
                    @elseif($order->status === 'Picked Up')
                        <span class="badge" style="background:#e0e7ff; color:#4338ca;"><i class="fa-solid fa-box text-xs"></i> Picked Up</span>
                    @elseif($order->status === 'On the Way')
                        <span class="badge" style="background:#dbeafe; color:#1d4ed8;"><i class="fa-solid fa-truck-fast text-xs"></i> Transit</span>
                    @elseif($order->status === 'Delivered')
                        <span class="badge badge-delivered"><i class="fa-solid fa-check text-xs"></i> Delivered</span>
                    @elseif($order->status === 'Delayed')
                        <span class="badge" style="background:#FFEBEE; color:#C62828;"><i class="fa-solid fa-clock-rotate-left text-xs"></i> Delayed</span>
                    @elseif($order->status === 'Not Delivered')
                        <span class="badge badge-cancelled"><i class="fa-solid fa-ban text-xs"></i> Failed Delivery</span>
                    @else
                        <span class="badge badge-cancelled"><i class="fa-solid fa-circle text-xs"></i> {{ $order->status }}</span>
                    @endif
                </td>
                <td style="vertical-align:top;">
                    @if($order->delivery_notes)
                        <div style="font-size:0.75rem;color:#C62828;background:#FFEBEE;padding:6px 10px;border-radius:6px;border:1px solid #ffcdd2;">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $order->delivery_notes }}
                        </div>
                    @else
                        <span style="color:var(--text-light);font-size:0.8rem;">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding:40px; color:var(--text-light);">
                    <i class="fa-solid fa-route text-3xl mb-3" style="color:#e2e8f0;display:block;"></i>
                    No active deliveries at the moment.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($deliveries->hasPages())
    <div style="padding:15px 24px; border-top:1px solid rgba(255,255,255,0.05);">
        {{ $deliveries->links() }}
    </div>
    @endif
</div>
@endsection
