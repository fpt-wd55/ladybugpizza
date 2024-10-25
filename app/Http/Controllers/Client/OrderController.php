<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $redirectHome = $this->checkUser();
        if ($redirectHome) {
            return $redirectHome; 
        }

        $status = $request->get('tab');

        $userId = Auth::id(); 
    
        $orders = Order::when($status, function ($query, $status) {
            return $query->whereHas('orderStatus', function ($q) use ($status) {
                $q->where('slug', $status);
            });
        })
        ->where('user_id', $userId) 
        ->with('orderItems.productAttributes.product', 'orderItems.toppings')
        ->paginate(10);

        $orderStatuses = OrderStatus::all();
        $invoices = Invoice::all();
        
        return view('clients.order.index', [
            'orderStatuses' => $orderStatuses,
            'invoices' => $invoices,
            'orders'=> $orders,
        ]);
    }

    public function invoice($invoiceNumber)
    {
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();
        $order = Order::where('id', $invoice->order_id)->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $transaction = Transaction::where('id', $invoice->transaction_id)->first();
        $user = User::where('id', $order->user_id)->first();

        return view('shared.invoice', [
            'invoice' => $invoice,
            'order' => $order,
            'transaction' => $transaction,
            'user' => $user,
            'orderItems' => $orderItems,
        ]);
    }

    public function postCancel(Order $order , Request $request)
    {
        $order = Order::query()->findOrFail($order['id']);
        $reasons = [
            1 => 'Muốn thay đổi địa chỉ giao hàng',
            2 => 'Muốn nhập/thay đổi mã Voucher',
            3 => 'Muốn thay đổi sản phẩm trong đơn hàng (size, topping, số lượng,...)',
            4 => 'Thủ tục thanh toán quá rắc rối',
            5 => 'Tìm thấy giá rẻ hơn ở chỗ khác',
            6 => 'Đổi ý, không muốn mua nữa',
            7 => $request->input('reason'), // lý do khác
        ];
        if ($order) {
            $selectedReason = $request->input('canceled_reason');
            $order->canceled_reason = isset($reasons[$selectedReason]) ? $reasons[$selectedReason] : null;
            $order->order_status_id = 6; 
            $order->save();
    
            return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
        }
    
        return redirect()->back()->with('error', 'Hủy đơn hàng thất bại');
    }

    public function rate()
    {
        return view('clients.order.rate');
    }

    public function postRate()
    {
    }
}
