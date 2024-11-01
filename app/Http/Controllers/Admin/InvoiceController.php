<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User; 

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($invoiceNumber)
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
}
