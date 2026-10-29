<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'is_admin' => true])) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password admin salah.'])->onlyInput('email');
    }

    public function dashboard()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        return view('admin.dashboard', [
            'totalUsers' => User::where('is_admin', false)->count(),
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'menunggu')->count(),
            'monthlyRevenue' => Order::whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('status', '!=', 'dibatalkan')
                ->sum('total'),
            'recentOrders' => Order::latest()->limit(8)->get(),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
