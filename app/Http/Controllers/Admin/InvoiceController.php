<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index() {
        $invoices = Invoice::latest('id')->paginate(10);
        return view('admins.invoice.index', compact('invoices'));
    }
    public function show()
    {
        return view('shared.invoice');
    }
}
