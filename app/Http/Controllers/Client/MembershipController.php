<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Log;
use App\Models\Membership;
use App\Models\MembershipRank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function membership()
    {
        $redirectHome = $this->checkUser();
        if ($redirectHome) {
            return $redirectHome;
        }
        $membership = Auth::user()->membership;
        $currentPoint = $membership->points;
        $points = $membership->total_spent;

        $ranks = MembershipRank::all();

        // 2. Tính rank dựa theo điểm
        $currentRank = $this->updateRank($ranks, $points);

        // 3. Kiểm tra rank
        if (!$currentRank) {
            return back()->with('error', 'Không tìm thấy hạng');
        }

        // 4. Tính số điểm cần có cho rank tiếp theo và progress bar 
        $nextPoints = max(0, $currentRank->max_points - $points);

        // Kiểm tra nếu max_points và min_points bằng nhau để tránh chia cho 0
        $progress = ($currentRank->max_points > $currentRank->min_points)
            ? (($points - $currentRank->min_points) / ($currentRank->max_points - $currentRank->min_points) * 100)
            : 100;

        // 5. Tìm rank tiếp theo
        $nextRank = null;
        foreach ($ranks as $rank) {
            if ($rank->min_points > $currentRank->max_points) {
                $nextRank = $rank;
                break;
            }
        }

        $maxRank = MembershipRank::orderBy('min_points', 'desc')->first();

        // 5. Hạng cao nhất thì không có hạng tiếp theo
        if ($currentRank->id === $maxRank->id) {
            $nextPoints = 0;
            $progress = 100;
        }

        // 6. Kiểm tra FAQ
        $faqs = Faq::all();

        return view('clients.profile.membership.index', [
            'rank' => $currentRank->name,
            'maxRank' => $maxRank->name,
            'points' => $points,
            'currentPoints' => $currentPoint,
            'nextPoints' => $nextPoints,
            'nextRank' => $nextRank ? $nextRank->name : 'Không có',
            'progress' => $progress,
            'img' => $currentRank->icon,
            'faqs' => $faqs
        ]);
    }

    public function membershipHistory(Request $request)
    {
        $redirectHome = $this->checkUser();
        if ($redirectHome) {
            return $redirectHome;
        }
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Lấy tab hiện tại, mặc định là 'receive'
        $tab = $request->get('tab', 'receive');

        // Lấy dữ liệu lịch sử dựa theo tab
        if ($tab == 'receive') {
            $histories = Log::where('user_id', $user->id)
                ->where('action', 'receive_points')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->appends(['tab' => 'receive']); // Thêm tham số tab;
        } elseif ($tab == 'change') {
            $histories = Log::where('user_id', $user->id)
                ->where('action', 'exchange_points')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->appends(['tab' => 'change']); // Thêm tham số tab;
        } else {
            $histories = collect(); // Nếu tab không hợp lệ, trả về collection rỗng
        }

        // Truyền dữ liệu vào view
        return view('clients.profile.membership.history', compact('histories', 'tab'));
    }
}
