<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $totalDeliveries = \App\Models\Order::count();
        $pendingDeliveries = \App\Models\Order::where('status', 'Pending')->count();
        $completedDeliveries = \App\Models\Order::where('status', 'Delivered')->count();
        $newOrdersToday = \App\Models\Order::whereDate('created_at', today())->count();

        // Get recent orders with users and items
        $recentOrders = \App\Models\Order::with(['user', 'items.product'])
                            ->orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();

        return view('admin.dashboard', compact(
            'totalDeliveries', 
            'pendingDeliveries', 
            'completedDeliveries', 
            'newOrdersToday', 
            'recentOrders'
        ));
    }

    /**
     * Poll for new notifications for the admin.
     */
    public function pollNotifications(Request $request)
    {
        $admin = \App\Models\User::where('role', 'admin')->first();
        if (!$admin) {
            return response()->json(['notifications' => [], 'timestamp' => now()->toIso8601String()]);
        }

        $query = $admin->notifications(); // use notifications() to get all or unread depending on needs

        $since = $request->query('since');
        if ($since) {
            // only get notifications strictly newer than the last check
            $query->where('created_at', '>', \Carbon\Carbon::parse($since));
        } else {
            // On first load, don't return old ones to avoid spamming toast
            // just return timestamp
            return response()->json([
                'notifications' => [],
                'timestamp' => now()->toIso8601String()
            ]);
        }

        $notifications = $query->get();

        return response()->json([
            'notifications' => $notifications,
            'timestamp' => now()->toIso8601String(),
            'total_unread' => $admin->unreadNotifications()->count()
        ]);
    }
}
