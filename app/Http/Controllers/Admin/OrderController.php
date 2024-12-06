<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;
use App\Mail\ThankYouOrder;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('tab');

        $orders = Order::query()
            ->when($status, function ($query, $status) {
                return $query->whereHas('orderStatus', function ($query) use ($status) {
                    return $query->where('slug', $status);
                });
            })->latest('id')->paginate(10);

        // get address order
        $orders->map(function ($order) {
            $order->province =  Province::find($order->address->province);
            $order->district = District::find($order->address->district);
            $order->ward = Ward::find($order->address->ward);
            return $order;
        });

        $orderStatuses = OrderStatus::withCount(['orders'])->get();
        $totalOrders = Order::count();
        $paymentMethods = PaymentMethod::all();
        $invoices = Invoice::all();
        return view('admins.order.index', compact('orders', 'invoices', 'orderStatuses', 'paymentMethods', 'totalOrders'));
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

        $statuses = OrderStatus::get();

        // get address order 
        $order->province =  Province::find($order->address->province);
        $order->district = District::find($order->address->district);
        $order->ward = Ward::find($order->address->ward);

        return view('admins.order.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $currentStatus = $order->orderStatus;
        $statuses = OrderStatus::pluck('slug')->toArray();

        $request->validate([
            'status' => ['required', 'string', Rule::in($statuses)],
            'canceled_reason' => 'nullable|string',
        ], [
            'status.required' => 'Trạng thái không được để trống.',
            'status.string' => 'Trạng thái không hợp lệ.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'canceled_reason.string' => 'Lý do hủy không đúng định dạng.',
        ]);

        $newStatus = OrderStatus::where('slug', $request->status)->first();

        if (!$newStatus || $newStatus->id < $currentStatus->id) {
            return redirect()->back()->with('error', 'Cập nhật đơn hàng không thành công.');
        }

        $nonCancellableStatuses = ['shipping', 'delivered', 'completed'];
        if (in_array($currentStatus->slug, $nonCancellableStatuses) && $newStatus->slug === 'cancelled') {
            return redirect()->back()->with('error', 'Cập nhật đơn hàng không thành công.');
        }

        $order->order_status_id = $newStatus->id;
        if ($newStatus->slug == 'canceled') {
            $order->canceled_reason = $request->canceled_reason;
            $order->canceled_at = now();
        }

        if ($newStatus->slug == 'completed') {
            $order->completed_at = now();

            // Tạo hóa đơn
            $dataInvoice = [
                'order_id' => $order->id,
                'invoice_number' => 'INV' . now()->format('Ymd') . '-' . $order->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            Invoice::create($dataInvoice);
        }

        // Gửi email cảm ơn
        if ($newStatus->slug == 'completed' && $currentStatus->slug != 'completed') {
            Mail::to($order->email)->send(new ThankYouOrder($order));
        }

        $order->save();

        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công.');
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

        // get address order
        $orders->map(function ($order) {
            $order->province =  Province::find($order->address->province);
            $order->district = District::find($order->address->district);
            $order->ward = Ward::find($order->address->ward);
            return $order;
        });

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
