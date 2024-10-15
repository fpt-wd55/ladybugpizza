<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;

use function Ramsey\Uuid\v1;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admins.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admins.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admins.product.detail', compact('product'));
}
    public function store(Request $request) {
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admins.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        //
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        //
    }
    public function favorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product')
            ->get();
        return view('partials.clients', compact('favorites'));
    }
}
