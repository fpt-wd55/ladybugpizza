<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $combos = Product::where('category_id', 7)->paginate(10);

        return view('admins.combo.index', compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = Product::where('category_id', 1)->get();
        $bases = AttributeValue::where('attribute_id', 1)->get();
        $sizes = AttributeValue::where('attribute_id', 2)->get();
        $sauces = AttributeValue::where('attribute_id',3)->get();
        $toppings = Topping::all();
        $categories = Category::whereNotIn('id', [1,7])->with('products')->get();
        return view('admins.combo.create', [
            'pizzas' => $pizzas,
            'bases' => $bases,
            'sizes' => $sizes,
            'sauces' => $sauces,
            'toppings' => $toppings,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admins.combo.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function trashCombo(){

    }

    public function restoreCombo() {

    }

    public function deleteCombo() {

    }

    public function forceDelete() {

    }
}
