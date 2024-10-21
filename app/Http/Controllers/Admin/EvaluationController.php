<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Product;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $product = Product::paginate(10);
       return view('admins.evaluations.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
          //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
    
    }

    public function updateStatus(Request $request,String $id)
    {
        $evaluation = Evaluation::query()->findOrFail($id);
        if ($evaluation) {
        $evaluation->status = $request->has('status') ? 1 : 2 ;
        $evaluation->save();

        return redirect()->back()->with('success','thay đổi trạng thái thành công');
        }
        return redirect()->back()->with('error','thay đổi trạng thái thất bại');  
    }

}
