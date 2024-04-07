<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route(request()->user()->role);
    }

    public function admin()
    {
        $newOrdersCount = Order::where('condition', 'processing')->count();
        $totalIncome = Order::where('condition', 'delivered')->sum('total_amount');

        $latestOrders = Order::latest()->take(5)->get(); 
        return view('admin.dashboard', compact('newOrdersCount', 'totalIncome', 'latestOrders'));
    }
    public function seller(){
        return view('/home');
    }

    public function customer(){
        return view('/home');
    }
}
