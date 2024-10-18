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
        $tab = $request->get('tab', 'history');
        $pointsHistory = [];
        // Lấy dữ liệu tương ứng với từng tab
        switch ($tab) {
            case 'receive':
                // Lấy dữ liệu cho "Lịch sử nhận"
                $logs = Log::where('user_id', $membership->user_id)
                    ->where('action', 'Cộng điểm')
                    ->get();
                foreach ($logs as $log) {
                    // "Ngày 3/10/2024 Cộng điểm mua hàng thành công vào lúc 08:30 tại LADYBUGPIZZA (+200)"
                    $cleanDescription = trim($log->description);
                    preg_match('/(\d{1,2}\/\d{1,2}\/\d{4})\s+(.*?)\s+vào lúc (\d{1,2}:\d{2})\s+tại\s+(.*?)\s*\(([-\+\d]+)\)/', $cleanDescription, $matches);

                    if (count($matches) === 6) {
                        $pointsHistory[] = [
                            'date'         => $matches[1],  // Ngày "3/10/10/2024"
                            'action'       => $matches[2],  // Hành động "Cộng điểm mua hàng thành công"
                            'time'         => $matches[3],  // Thời gian "08:30"
                            'location'     => $matches[4],  // Địa điểm "LADYBUGPIZZA"
                            'points' => $matches[5],  // Điểm "+200"
                        ];
                    }
                }
                break;

            case 'change':
                // Lấy dữ liệu cho "Lịch sử đổi"
                $logs = Log::where('user_id', $membership->user_id)
                    ->where('action', 'Đổi điểm')
                    ->get();
                foreach ($logs as $log) {
                    // "Ngày 3/10/2024 Đổi phiếu mua hàng thành công vào lúc 08:30 tại LADYBUGPIZZA (-200)"
                    $cleanDescription = preg_replace('/\s+/', ' ', trim($log->description));
                    preg_match('/Ngày\s*(\d{1,2}\/\d{1,2}\/\d{4})\s+(.*?)\s+vào lúc\s*(\d{1,2}:\d{2})\s+tại\s+(.*?)\s*\(([-\d]+)\)/', $cleanDescription, $matches);
                    if (count($matches) === 6) {
                        $pointsHistory[] = [
                            'date'          => $matches[1],  // Ngày: "3/10/2024"
                            'action'        => $matches[2],  // Hành động: "Đổi phiếu mua hàng thành công"
                            'time'          => $matches[3],  // Thời gian: "08:30"
                            'location'      => $matches[4],  // Địa điểm: "LADYBUGPIZZA"
                            'points' => $matches[5],  // Điểm: "-200"
                        ];
                    }
                }
                break;

            case 'history':
                // lấy toàn bộ dữ liệu
            default:
                $logs = Log::where('user_id', $membership->user_id)
                    ->whereIn('action', ['Cộng điểm', 'Đổi điểm'])
                    ->get();

                foreach ($logs as $log) {
                    // Kiểm tra nếu là "Cộng điểm"
                    if ($log->action == 'Cộng điểm') {
                        $cleanDescription = trim($log->description);
                        preg_match('/(\d{1,2}\/\d{1,2}\/\d{4})\s+(.*?)\s+vào lúc (\d{1,2}:\d{2})\s+tại\s+(.*?)\s*\(([-\+\d]+)\)/', $cleanDescription, $matches);
                        if (count($matches) === 6) {
                            $pointsHistory[] = [
                                'date'         => $matches[1],  // Ngày "3/10/10/2024"
                                'action'       => $matches[2],  // Hành động "Cộng điểm mua hàng thành công"
                                'time'         => $matches[3],  // Thời gian "08:30"
                                'location'     => $matches[4],  // Địa điểm "LADYBUGPIZZA"
                                'points' => $matches[5],  // Điểm "+200"
                            ];
                        }
                    }
                    else if ($log->action == 'Đổi điểm') {
                        $cleanDescription = preg_replace('/\s+/', ' ', trim($log->description));
                        preg_match('/Ngày\s*(\d{1,2}\/\d{1,2}\/\d{4})\s+(.*?)\s+vào lúc\s*(\d{1,2}:\d{2})\s+tại\s+(.*?)\s*\(([-\d]+)\)/', $cleanDescription, $matches);
                        if (count($matches) === 6) {
                            $pointsHistory[] = [
                                'date'          => $matches[1],  // Ngày: "3/10/2024"
                                'action'        => $matches[2],  // Hành động: "Đổi phiếu mua hàng thành công"
                                'time'          => $matches[3],  // Thời gian: "08:30"
                                'location'      => $matches[4],  // Địa điểm: "LADYBUGPIZZA"
                                'points' => $matches[5],  // Điểm: "-200"
                            ];
                        }
                    }
                }
                break;
        }
        // END HISTORY
        // Trả về view với dữ liệu của thành viên, rank, và progress,history,tab
        return view('admins.memberships.edit', compact('membership', 'progress', 'img', 'rank', 'pointsHistory', 'tab'));
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
