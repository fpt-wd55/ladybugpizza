<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('tab'); // Change 'status' to 'tab'

        $orders = Order::when($status, function ($query, $status) {
            return $query->whereHas('orderStatus', function ($q) use ($status) {
                $q->where('slug', $status); // Ensure you're querying the 'slug' column
            });
        })->with('orderItems.productAttributes.product', 'orderItems.toppings')
            ->latest('id')
            ->paginate(10);

        dd($orders);

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
}
