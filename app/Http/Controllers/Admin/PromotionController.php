<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Category;
use App\Models\MembershipRank;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ranks = MembershipRank::get();

        $promotions = Promotion::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admins.promotions.index', compact('promotions', 'ranks'));
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
        if (strpos($data['is_global'], '|') !== false) {
            [$data['is_global'], $data['rank_id']] = explode('|', $data['is_global']);
        } else {
            $data['rank_id'] = null;
        }
        if ($data['is_global'] == 1) {
            $data['rank_id'] = null;
        } else {
            if (!isset($data['rank_id']) || empty($data['rank_id'])) {
                return back()->withErrors(['rank_id' => 'Vui lòng chọn cấp bậc nếu không áp dụng cho tất cả.']);
            }
        }
        $data['code'] = strtoupper(Str::random(5)) . strtolower(Str::random(5));
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
        if (strpos($data['is_global'], '|') !== false) {
            [$data['is_global'], $data['rank_id']] = explode('|', $data['is_global']);
        } else {
            $data['rank_id'] = null;
        }
        if ($data['is_global'] == 1) {
            $data['rank_id'] = null;
        } else {
            if (!isset($data['rank_id']) || empty($data['rank_id'])) {
                return back()->withErrors(['rank_id' => 'Vui lòng chọn cấp bậc nếu không áp dụng cho tất cả.']);
            }
        }
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
        $ranks = MembershipRank::get();
        $promotions = Promotion::query()
            ->orderBy('quantity', 'desc')
            ->where('code', 'like', '%' . $request->search . '%')
            ->paginate(10);
        $promotions->appends(['search' => $request->search]);
        return view('admins.promotions.index', compact('promotions', 'ranks'));
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
        $query = Promotion::query();

        if (isset($request->filter_discount_type)) {
            $query->whereIn('discount_type', $request->filter_discount_type);
        }

        if (isset($request->filter_range) && in_array(0, $request->filter_range)) {
            $query->where('is_global', 1);
        }

        if (isset($request->filter_range) && !in_array(0, $request->filter_range)) {
            $query->where('is_global', 2);
            $query->whereIn('rank_id', $request->filter_range);
        }

        if (isset($request->filter_date_min)) {
            $query->where('start_date', '>=', $request->filter_date_min);
        }

        if (isset($request->filter_date_max)) {
            $query->where('end_date', '<=', $request->filter_date_max);
        }

        $promotions = $query->paginate(10);

        $promotions->appends([
            'filter_discount_type' => $request->filter_discount_type,
            'filter_range' => $request->filter_range,
            'filter_date_min' => $request->filter_date_min,
            'filter_date_max' => $request->filter_date_max,
        ]);

        $ranks = MembershipRank::get();

        return view('admins.promotions.index', compact('promotions', 'ranks'));
    }
}
