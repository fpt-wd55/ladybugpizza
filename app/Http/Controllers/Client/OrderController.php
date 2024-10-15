<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orderStatuses = OrderStatus::all();

        return view('clients.order.index', [
            'orderStatuses' => $orderStatuses,
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
