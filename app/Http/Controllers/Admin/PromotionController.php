<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::query()
            ->orderBy('quantity', 'desc')
            ->paginate(10);
        return view('admins.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.promotions.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromotionRequest $request)
    {
        $data = $request->all();
        if (Promotion::query()->create($data)) {
            return redirect()->route('admin.promotions.index')->with('success', 'Thêm mã giảm giá thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm mã giảm giá thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        $data = $promotion->all();
        return view('admins.promotions.detail', compact('promotion', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('admins.promotions.edit', [
            'editPromotion' => $promotion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PromotionRequest $request, Promotion $promotion)
    {
        $data = $request->all();

        if ($promotion->update($data)) {
            return redirect()->back()->with('success', 'Cập nhật mã giảm giá thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật mã giảm giá thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if ($promotion->delete()) {
            return redirect()->back()->with('success', 'Xóa mã giảm giá thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa mã giảm giá thất bại');
        }
    }
    public function export()
    {
        $this->exportExcel(Promotion::all(), 'danhsachmagiamgia');
    }

    public function search(Request $request)
    {
        $promotions = Promotion::query()
            ->orderBy('quantity', 'desc')
            ->where('code', 'like', '%' . $request->search . '%')
            ->paginate(10);
        $promotions->appends(['search' => $request->search]);
        return view('admins.promotions.index', compact('promotions'));
    }
}
