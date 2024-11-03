<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Category;
use App\Models\MembershipRank;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $ranks = MembershipRank::get();

        $promotions = Promotion::query()
            ->orderBy('quantity', 'desc')
            ->paginate(10);
        return view('admins.promotions.index', compact('promotions', 'categories', 'ranks'));
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

    public function bulkAction(Request $request)
    {
        $selectedIds = explode(',', $request->input('selected_ids'));
        $action = $request->input('action');

        if ($action == 'delete') {
            Promotion::whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with('success', 'Xóa mã giảm giá thành công');
        } else if ($action == 'force_delete') {
            foreach ($selectedIds as $id) {
                $forcePromotion = Promotion::withTrashed()->find($id);
                if ($forcePromotion) {
                    $forcePromotion->forceDelete();
                } else {
                    return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
                }
            }
            return redirect()->back()->with('success', 'Xóa vĩnh viễn mã giảm giá thành công');
        } else if ($action == 'restore') {
            Promotion::withTrashed()->whereIn('id', $selectedIds)->restore();
            return redirect()->back()->with('success', 'Khôi phục mã giảm giá thành công');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
    }

    public function filter(Request $request)
    {
        // $query = Topping::query();

        // if (isset($request->filter_category)) {
        //     $query->whereIn('category_id', $request->filter_category);
        // }

        // if (isset($request->filter_price_min)) {
        //     $query->where('price', '>=', $request->filter_price_min);
        // }

        // if (isset($request->filter_price_max)) {
        //     $query->where('price', '<=', $request->filter_price_max);
        // }

        // $toppings = $query->paginate(10);

        // $toppings->appends(['filter_category' => $request->filter_category]);
        // $toppings->appends(['filter_price_min' => $request->filter_price_min]);
        // $toppings->appends(['filter_price_max' => $request->filter_price_max]);

        // $categories = Category::all();

        // return view('admins.toppings.index', compact('toppings', 'categories'));
    }
}
