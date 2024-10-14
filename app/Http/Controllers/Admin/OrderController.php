<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status'); // Lấy trạng thái từ query parameter

        if($status){
            $orders = Order::when($status, function ($query, $status) {
                return $query->whereHas('orderStatus', function ($q) use ($status) {
                    $q->where('name', $status);
                });
            })->latest('id')->paginate(10);
        }else{
            // Query dựa theo trạng thái, nếu không có thì lấy tất cả đơn hàng
            $orders = Order::latest('id')->paginate(10);
        }

        $invoices = Invoice::all();
        return view('admins.order.index', compact('orders','invoices'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function invoices(){
        $invoices = Invoice::all();
        return view('admins.order.detail',compact('invoices'));
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orders = Order::find($id);
        return view('admins.order.detail',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
