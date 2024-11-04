<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderStatus; 
use Illuminate\Http\Request; 

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('tab'); // Change 'status' to 'tab'

        $orders = Order::query() // Change 'Order::all()' to 'Order::query()'
            ->when($status, function ($query, $status) {
                return $query->whereHas('orderStatus', function ($query) use ($status) {
                    return $query->where('slug', $status);
                });
            })->latest('id')->paginate(10);

        $orderStatuses = OrderStatus::all();
        $invoices = Invoice::all();
        return view('admins.order.index', compact('orders', 'invoices', 'orderStatuses'));
    }

    /**
     * Display a listing of the resource.
     */
    public function invoices()
    {
        $invoices = Invoice::all();
        return view('admins.order.detail', compact('invoices'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orders = Order::find($id);
        return view('admins.order.detail', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $statuses = ['Hoàn thành', 'Đang giao hàng', 'Đang tìm tài xế', 'Chờ xác nhận', 'Đã xác nhận', 'Đã hủy'];
        return view('admins.order.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Xác thực dữ liệu
        $request->validate([
            'status' => 'required|string|in:Hoàn thành,Đang giao hàng,Đang tìm tài xế,Chờ xác nhận,Đã xác nhận,Đã hủy',
        ]);

        // Cập nhật trạng thái
        $order->orderStatus->name = $request->status;
        $order->orderStatus->save();

        return redirect()->route('admin.orders.edit', $id)->with('success', 'Trạng thái đã được cập nhật!');
    }
    
    public function export()
    {
        $this->exportExcel(Order::all(), 'danhsachdonhang');
    }

    public function filter(Request $request)
    {
        // $query = User::query();

        // if (isset($request->filter_role)) {
        //     $query->whereIn('role_id', $request->filter_role);
        // }

        // if (isset($request->filter_status)) {
        //     $query->whereIn('status', $request->filter_status);
        // }

        // if (isset($request->filter_gender)) {
        //     $query->whereIn('gender', $request->filter_gender);
        // } 
        
        // if (isset($request->filter_birthday_start)) {
        //     $query->where('date_of_birth', '>=', $request->filter_birthday_start);
        // }

        // if (isset($request->filter_birthday_end)) {
        //     $query->where('date_of_birth', '<=', $request->filter_birthday_end);
        // }

        // $users = $query->paginate(10);

        // $users->appends(['filter_role' => $request->filter_role]);
        // $users->appends(['filter_status' => $request->filter_status]);
        // $users->appends(['filter_gender' => $request->filter_gender]);
        // $users->appends(['filter_birthday_start' => $request->filter_birthday_start]);
        // $users->appends(['filter_birthday_end' => $request->filter_birthday_end]);

        // $roles = Role::where('id', '>', 1)->get();
        // return view('admins.user.index', compact('users', 'roles'));
    }
}
