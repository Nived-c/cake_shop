<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Product::where('is_available', true)->with('category');

            if ($request->filled('category')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }

            if ($request->filled('q')) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('description', 'like', '%' . $request->q . '%');
                });
            }

            switch ($request->sort) {
                case 'price_asc':  $query->orderBy('base_price', 'asc'); break;
                case 'price_desc': $query->orderBy('base_price', 'desc'); break;
                case 'name':       $query->orderBy('name', 'asc'); break;
                default:           $query->latest(); break;
            }

            $products   = $query->paginate(12);
            $allCount   = Product::where('is_available', true)->count();
            $categories = Category::where('is_active', true)
                ->withCount(['products' => fn($q) => $q->where('is_available', true)])
                ->orderBy('name')
                ->get();
        } catch (\Exception $e) {
            $products   = collect();
            $allCount   = 0;
            $categories = collect();
        }

        return view('shop.products', compact('products', 'categories', 'allCount'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
                          ->where('is_available', true)
                          ->with(['category', 'images', 'variations'])
                          ->firstOrFail();

        $related = Product::where('category_id', $product->category_id)
                           ->where('id', '!=', $product->id)
                           ->where('is_available', true)
                           ->take(4)
                           ->get();

        return view('shop.product-detail', compact('product', 'related'));
    }
}
