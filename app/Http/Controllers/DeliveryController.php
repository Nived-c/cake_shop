<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    /**
     * Show Delivery Boy Login Form
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'delivery_boy') {
            return redirect()->route('delivery.dashboard');
        }
        return view('delivery.login');
    }

    /**
     * Handle Login Submission
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (Auth::user()->role === 'delivery_boy') {
                $request->session()->regenerate();
                return redirect()->intended(route('delivery.dashboard'));
            }
            // Wrong role
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access. You are not a registered delivery driver.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('delivery.login');
    }

    /**
     * Delivery Boy Dashboard
     */
    public function dashboard()
    {
        if (Auth::user()->role !== 'delivery_boy') {
            abort(403);
        }

        $driverId = Auth::id();

        // Get orders assigned to this driver that are active
        $orders = Order::with(['user', 'items.product'])
            ->where('delivery_boy_id', $driverId)
            ->whereNotIn('status', ['Delivered', 'Cancelled', 'Not Delivered'])
            ->orderBy('delivery_date', 'asc')
            ->get();

        // Work reports stats
        $stats = [
            'total_delivered' => Order::where('delivery_boy_id', $driverId)->where('status', 'Delivered')->count(),
            'monthly_delivered' => Order::where('delivery_boy_id', $driverId)->where('status', 'Delivered')->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year)->count(),
            'today_delivered' => Order::where('delivery_boy_id', $driverId)->where('status', 'Delivered')->whereDate('updated_at', today())->count(),
            'active_count' => Order::where('delivery_boy_id', $driverId)->whereNotIn('status', ['Delivered', 'Cancelled', 'Not Delivered'])->count(),
            'delayed_count' => Order::where('delivery_boy_id', $driverId)->where('status', 'Delayed')->count(),
        ];

        return view('delivery.dashboard', compact('orders', 'stats'));
    }

    /**
     * Update Order Status
     */
    public function updateStatus(Request $request, Order $order)
    {
        if (Auth::user()->role !== 'delivery_boy' || $order->delivery_boy_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $request->validate([
            'status' => 'required|in:Picked Up,On the Way,Delivered,Delayed,Not Delivered',
            'reason' => 'required_if:status,Delayed,Not Delivered|string|nullable'
        ]);

        $oldStatus = $order->status;
        $order->status = $request->status;
        if ($request->has('reason') && $request->reason) {
            $order->delivery_notes = $request->reason;
        }
        $order->save();

        // Fire notification to admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\OrderStatusUpdated($order, $oldStatus));

        return response()->json(['success' => true, 'status' => $order->status]);
    }
}
