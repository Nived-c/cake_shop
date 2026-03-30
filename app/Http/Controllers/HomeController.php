<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdvertisementBanner;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $products = Product::where('is_available', true)
                ->with('category')
                ->latest()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $products = collect();
        }

        try {
            $advertisements = AdvertisementBanner::where('is_active', true)->get();
        } catch (\Exception $e) {
            $advertisements = collect();
        }

        return view('welcome', compact('products', 'advertisements'));
    }
}
