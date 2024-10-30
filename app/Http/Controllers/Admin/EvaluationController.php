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
        $products = Product::paginate(10);
        return view('admins.evaluations.index', compact('products'));
    }

    public function updateStatus(Request $request, String $id)
    {
        $evaluation = Evaluation::query()->findOrFail($id);
        if ($evaluation) {
            $evaluation->status = $request->has('status') ? 1 : 2;
            $evaluation->save();

            return redirect()->back()->with('success', 'thay đổi trạng thái thành công');
        }
        return redirect()->back()->with('error', 'thay đổi trạng thái thất bại');
    }

    public function export()
    {
        $this->exportExcel(Evaluation::all(), 'danhsachdanhgia');
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        $products->appends(['search' => $request->search]);
        return view('admins.evaluations.index', compact('products'));
    }
}
