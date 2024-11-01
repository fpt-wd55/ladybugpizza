<?php

namespace App\Http\Controllers\Admin;

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
        $ranks = MembershipRank::all()->keyBy('min_points');

        // Lấy danh sách các membership 
        $memberships = Membership::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role_id', 2);
            })
            ->paginate(10);

        // Trả về view với dữ liệu memberships
        return view('admins.memberships.index', compact('memberships', 'ranks'));
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

    public function search(Request $request)
    {
        $search = $request->search;

        // Lấy tất cả các rank từ bảng membershipranks
        $ranks = MembershipRank::all();
        // Lấy danh sách các membership và user where like username, email, fullname
        $memberships = Membership::with('user')
            ->whereHas('user', function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('fullname', 'like', '%' . $search . '%');
            })
            ->paginate(10);
        $memberships->appends(['search' => $search]);
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

    public function filter(Request $request)
    {
        // Lấy tất cả các rank từ bảng membershipranks
        $ranks = MembershipRank::all()->keyBy('min_points');

        // Lấy danh sách các membership  
        $query = Membership::query();
        $query->whereHas('user', function ($query) {
            $query->where('role_id', 2);
        });

        // Lọc theo rank 
        if (isset($request->filter_rank)) {
            $query->whereIn('rank_id', $request->filter_rank);
        }

        $memberships = $query->paginate(10);

        $memberships->appends(['filter_rank' => $request->filter_rank]);

        // Trả về view với dữ liệu memberships
        return view('admins.memberships.index', compact('memberships', 'ranks'));
    }
}
