<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttribute;
use App\Models\OrderItemTopping;
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

        foreach ($orderItems as $orderItem) {
            $orderItem->attributes = OrderItemAttribute::where('order_item_id', $orderItem->id)->get();
            $orderItem->toppings = OrderItemTopping::where('order_item_id', $orderItem->id)->get();
        }
        $user = User::where('id', $order->user_id)->first();
        return view('shared.invoice', [
            'invoice' => $invoice,
            'order' => $order,
            'user' => $user,
            'orderItems' => $orderItems,
        ]);
    }
}
