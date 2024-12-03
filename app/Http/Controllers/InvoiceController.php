<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttribute;
use App\Models\OrderItemTopping;
use App\Models\User;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

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
        $user = User::where('id', $order->user_id)->first();

        foreach ($orderItems as $orderItem) {
            $orderItem->attributes = OrderItemAttribute::where('order_item_id', $orderItem->id)->get();
            $orderItem->toppings = OrderItemTopping::where('order_item_id', $orderItem->id)->get();
        }

        // get address order 
        $order->province =  Province::find($order->address->province);
        $order->district = District::find($order->address->district);
        $order->ward = Ward::find($order->address->ward);

        return view('shared.invoice', [
            'invoice' => $invoice,
            'order' => $order,
            'user' => $user,
            'orderItems' => $orderItems,
        ]);
    }
}
