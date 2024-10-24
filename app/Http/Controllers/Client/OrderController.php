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

    public function postCancel()
    {
    }

    public function rate()
    {
        return view('clients.order.rate');
    }

    public function postRate()
    {
    }
}
