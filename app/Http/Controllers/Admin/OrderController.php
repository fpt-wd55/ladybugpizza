<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Order as MailOrder;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;
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
            $order->province = Province::find($order->address->province);
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
    //    public function show($id)
    //    {
    //        $orders = Order::find($id);
    //        return view('admins.order.detail', compact('orders'));
    //    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        $statuses = OrderStatus::get();

        // get address order
        $order->province = Province::find($order->address->province);
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
        ], [
            'status.required' => 'Trạng thái không được để trống.',
            'status.string' => 'Trạng thái không hợp lệ.',
            'status.in' => 'Trạng thái không hợp lệ.',
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
        if ($newStatus->slug == 'cancelled') {
            if (!isset($request->cancelled_reason)) {
                return redirect()->back()->with('error', 'Vui lòng nhập lý do hủy.');
            }
            $order->cancelled_reason = $request->cancelled_reason;
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

        $order->save();

        // Gửi email câp nhật trạng thái
        $userSetting = $order->user->setting;
        if ($userSetting->email_order) {
            switch ($newStatus->slug) {
                case 'waiting':
                    if ($currentStatus->slug != 'waiting') {
                        $subject = 'Thông báo xác nhận đơn hàng #' . $order->code;
                        Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.waiting'));
                    }
                    break;
                case 'confirmed':
                    if ($currentStatus->slug != 'confirmed') {
                        // Lấy thông tin địa chỉ
                        $order->province = Province::find($order->address->province);
                        $order->district = District::find($order->address->district);
                        $order->ward = Ward::find($order->address->ward);
                        $subject = 'Đơn hàng #' . $order->code . ' đã được xác nhận';
                        Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.confirmed'));
                    }
                    break;
                case 'shipping':
                    if ($currentStatus->slug != 'shipping') {
                        $subject = 'Đơn hàng #' . $order->code . ' đã được giao cho đơn vị vận chuyển';
                        Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.shipping'));
                    }
                    break;
                case 'delivered':
                    if ($currentStatus->slug != 'delivered') {
                        $subject = 'Đơn hàng #' . $order->code . ' đã được giao thành công';
                        Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.delivered'));
                    }
                    break;
                case 'completed':
                    if ($currentStatus->slug != 'completed') {
                        $subject = 'Cảm ơn bạn đã mua hàng tại cửa hàng chúng tôi';
                        Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.completed'));
                    }
                    break;
                case 'cancelled':
                    if ($currentStatus->slug != 'cancelled') {
                        $subject = 'Đơn hàng #' . $order->code . ' đã bị hủy';
                        Mail::to($order->email)->send(new MailOrder($order, $subject, 'mails.orders.cancelled'));
                    }
                    break;
                default:
                    break;
            }
        }


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
            $query->whereDate('created_at', '>=', $request->filter_date_min);
        }

        if (isset($request->filter_date_max)) {
            $query->whereDate('created_at', '<=', $request->filter_date_max);
        }

        $orders = $query->paginate(10);

        // get address order
        $orders->map(function ($order) {
            $order->province = Province::find($order->address->province);
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

    public function search(Request $request)
    {
        $status = $request->get('tab');
        $search = $request->get('search');

        // Lọc đơn hàng theo trạng thái và tìm kiếm
        $orders = Order::query()
            ->when($status, function ($query, $status) {
                // Lọc theo trạng thái đơn hàng
                $query->whereHas('orderStatus', function ($query) use ($status) {
                    $query->where('slug', $status);
                });
            })
            ->when($search, function ($query) use ($search) {
                // Tìm kiếm theo từ khóa
                $query->where(function ($query) use ($search) {
                    //tìm theo tổng số tiền
                    $query->whereRaw("amount + shipping_fee - discount_amount LIKE ?", ['%' . $search . '%'])
                        // Tìm theo các trường khác
                        ->orWhere('fullname', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        // tìm theo địa chỉ
                        ->orWhereHas('address', function ($query) use ($search) {
                            $query->where('detail_address', 'like', '%' . $search . '%')
                                ->orWhere('province', 'like', '%' . $search . '%')
                                ->orWhere('district', 'like', '%' . $search . '%')
                                ->orWhere('ward', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest('id')
            ->paginate(10);

        // Thêm dữ liệu tỉnh, huyện, xã vào đơn hàng
        $orders->map(function ($order) {
            $order->province = Province::find($order->address->province);
            $order->district = District::find($order->address->district);
            $order->ward = Ward::find($order->address->ward);
            return $order;
        });


        $orderStatuses = OrderStatus::withCount(['orders'])->get();
        $totalOrders = Order::count();
        $paymentMethods = PaymentMethod::all();
        $invoices = Invoice::all();

        // Trả về view với dữ liệu đã tìm kiếm
        return view('admins.order.index', compact('orders', 'invoices', 'orderStatuses', 'paymentMethods', 'totalOrders'));
    }


}
