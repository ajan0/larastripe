<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserInfoRequest;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard.indexAccount');
    }
    
    public function indexAccount()
    {
        return view('dashboard.account');
    }
    
    public function indexBooks()
    {
        return view('dashboard.books')->with('books', Auth::user()->books);
    }
    
    public function indexOrders()
    {
        return view('dashboard.orders')->with('books', Auth::user()->orders);
    }

    public function indexSales()
    {
        // Retrieve all transactions.
        $sales = OrderItem::whereIn('book_id', [Auth::user()->books->pluck('id')])->get();
        return view('dashboard.sales')->with('sales', $sales);
    }

    public function store(UpdateUserInfoRequest $request)
    {
        Auth::user()->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
        ]);
        
        return back();
    }
}
