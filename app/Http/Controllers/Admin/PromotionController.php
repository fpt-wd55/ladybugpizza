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
        Promotion::query()->create($data);
        return redirect()->route('admin.promotions.index')->with('message', 'Thêm mã giảm giá thành công');
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

        $promotion->update($data);
        return redirect()->route('admin.promotions.index')->with('message', 'Cập nhật mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back()->with('message', 'Xóa thành công');
    }
}
