<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Role;
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
        $paymentMethods = PaymentMethod::all();
        $invoices = Invoice::all();
        return view('admins.order.index', compact('orders', 'invoices', 'orderStatuses', 'paymentMethods'));
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
        $query = Order::query();

        if (isset($request->filter_status)) {
            $query->whereIn('order_status_id', $request->filter_status);
        } 

        if (isset($request->filter_paymentMethod)) {
            $query->whereIn('payment_method_id', $request->filter_paymentMethod);
        } 

        if (isset($request->filter_amount_min)) {
            $query->where('amount', '>=', $request->filter_amount_min);
        }

        if (isset($request->filter_amount_max)) {
            $query->where('amount', '<=', $request->filter_amount_max);
        }  

        if (isset($request->filter_date_min)) {
            $query->where('created_at', '>=', $request->filter_date_min);
        }

        if (isset($request->filter_date_max)) {
            $query->where('created_at', '<=', $request->filter_date_max);
        }    

        $orders = $query->paginate(10);

        $orders->appends(['filter_role' => $request->filter_role]);
        $orders->appends(['filter_status' => $request->filter_status]);
        $orders->appends(['filter_gender' => $request->filter_gender]);
        $orders->appends(['filter_birthday_start' => $request->filter_birthday_start]);
        $orders->appends(['filter_birthday_end' => $request->filter_birthday_end]);

        $orderStatuses = OrderStatus::all();
        $paymentMethods = PaymentMethod::all();
        $invoices = Invoice::all();
        return view('admins.order.index', compact('orders', 'invoices', 'orderStatuses', 'paymentMethods'));
    }
}
