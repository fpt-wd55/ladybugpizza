<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\MembershipRank;
use App\Http\Controllers\Controller;
use App\Models\Log;

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
        // Gán màu cho từng rank
        foreach ($memberships as $membership) {
            switch ($membership->rank_name) {
                case 'Đồng':
                    $membership->rank_color = 'text-[#C67746]';
                    break;
                case 'Bạc':
                    $membership->rank_color = 'text-gray-500';
                    break;
                case 'Vàng':
                    $membership->rank_color = 'text-yellow-300';
                    break;
                case 'Kim Cương':
                    $membership->rank_color = 'text-blue-400';
                    break;
                default:
                    $membership->rank_color = 'text-gray-100';
            }
        }
        // Trả về view với dữ liệu memberships
        return view('admins.memberships.index', compact('memberships'));
    }

    public function show(Membership $membership) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership, Request $request)
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


        // HISTORY 
        $histories = [];
        $histories['all'] = Log::where('user_id', $membership->user_id)
            ->whereIn('action', ['receive_points', 'exchange_points'])
            ->get();
        $histories['receive'] = Log::where('user_id', $membership->user_id)
            ->where('action', 'receive_points')
            ->get();
        $histories['exchange'] = Log::where('user_id', $membership->user_id)
            ->where('action', 'exchange_points')
            ->get();
        // END HISTORY
        // Trả về view với dữ liệu của thành viên, rank, và progress,history,tab
        return view('admins.memberships.edit', compact('membership', 'progress', 'img', 'rank', 'histories'));
    }
    public function export()
    {
        $memberships = Membership::all();
        $this->exportExcel($memberships, 'danhsachdiemthanhvien');
    }
}
