<?php

namespace App\Http\Controllers\Admin;

use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\MembershipRank;
use App\Http\Controllers\Controller;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả các rank từ bảng membershipranks
        $ranks = MembershipRank::all();
        // Lấy danh sách các membership và user
        $memberships = Membership::with('user')->paginate(10);
        // Lặp qua từng membership và tính rank dựa theo điểm
        foreach ($memberships as $membership) {
            $points = $membership->points; // Lấy điểm của thành viên hiện tại
            $currentRank = null;
            // Tìm rank phù hợp từ bảng membershipranks
            foreach ($ranks as $rank) {
                if ($points >= $rank->min_points) {
                    $currentRank = $rank;
                }
            }
            // Gán rank cho mỗi membership
            $membership->rank_name = $currentRank->name;
            $membership->rank_img = $currentRank->icon;
        }
        // Trả về view với dữ liệu memberships
        return view('admins.memberships.index', compact('memberships'));
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

    public function show(Membership $membership)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        $points = $membership->points;

        // Lấy tất cả các rank từ bảng membershipranks và sắp xếp theo min_points
        $ranks = MembershipRank::orderBy('min_points', 'asc')->get();

        // 2. Tính rank hiện tại dựa theo điểm của thành viên
        $currentRank = null;
        foreach ($ranks as $rank) {
            if ($points >= $rank->min_points) {
                $currentRank = $rank;
            }
        }
        // 4. Tính số điểm cần có cho rank tiếp theo và progress bar
        $nextRank = $ranks->where('min_points', '>', $points)->first(); // Tìm rank tiếp theo
        if ($nextRank) {
            $progress = ($points - $currentRank->min_points) / ($nextRank->min_points - $currentRank->min_points) * 100;
        } else {
            // Nếu không có rank tiếp theo (đang ở rank cao nhất)
            $progress = 100;
        }


        // 5. Lấy thông tin rank hiện tại
        $img = $currentRank->icon;
        $rank = $currentRank->name;

        // Trả về view với dữ liệu của thành viên, rank, và progress
        return view('admins.memberships.edit', compact('membership', 'progress', 'img', 'rank'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        //
    }


    public function updateStatus(Request $request, Membership $membership)
    {
        $membership->status = $request->status ? 1 : 2;
        $membership->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
