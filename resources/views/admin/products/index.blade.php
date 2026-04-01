@extends('admin.layouts.app')

@section('title', 'All Products')
@section('header_title', 'Product Catalog')
@section('header_subtitle', 'Manage cake availability and pricing')

@section('content')
<div class="data-table">
    <div style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="font-serif-elegant text-xl font-bold" style="color:var(--primary);">Our Catalog</div>
        <div style="font-size:0.85em;color:var(--text-light);">{{ $products->total() }} items</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Base Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    <div style="width:40px;height:40px;border-radius:8px;background:rgba(178,145,95,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);">
                        <i class="fa-solid fa-cake-candles"></i>
                    </div>
                </td>
                <td>
                    <div style="font-weight:600;color:var(--text-dark);">{{ $product->name }}</div>
                    <div style="font-size:0.75rem;color:var(--text-light);max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $product->description }}</div>
                </td>
                <td>
                    <span style="font-size:0.8rem;background:rgba(255,255,255,0.05);color:var(--text-light);padding:4px 8px;border-radius:4px;font-weight:600;">
                        {{ optional($product->category)->name ?? 'Uncategorized' }}
                    </span>
                </td>
                <td style="font-weight:700;color:var(--text-dark);">AED {{ number_format($product->base_price, 2) }}</td>
                <td>
                    @if($product->is_available)
                        <span class="badge badge-delivered"><i class="fa-solid fa-check text-xs"></i> Available</span>
                    @else
                        <span class="badge badge-cancelled"><i class="fa-solid fa-xmark text-xs"></i> Out of Stock</span>
                    @endif
                </td>
                <td>
                    <a href="#" style="color:var(--primary);margin-right:10px;"><i class="fa-solid fa-pen"></i> Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding:40px; color:var(--text-light);">
                    <i class="fa-solid fa-box-open text-3xl mb-3" style="color:#e2e8f0;display:block;"></i>
                    No products found in the catalog.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($products->hasPages())
    <div style="padding:15px 24px; border-top:1px solid rgba(255,255,255,0.05);">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
