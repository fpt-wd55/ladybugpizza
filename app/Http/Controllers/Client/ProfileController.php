<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function index()
	{
		return view('clients.profile.index');
	}

	public function postUpdate(Request $request)
	{
	}

	public function postChangePassword(Request $request)
	{
	}

	public function postInactive(Request $request)
	{
	}

	public function membership()
	{
		// 1. Điểm và rank
		$points = 2850;
		$ranks = [
			['min' => 0, 'max' => 1000, 'rank' => 'Đồng', 'img' => 'storage/uploads/ranks/bronze.svg'],
			['min' => 1001, 'max' => 3000, 'rank' => 'Bạc', 'img' => 'storage/uploads/ranks/silver.svg'],
			['min' => 3001, 'max' => 10000, 'rank' => 'Vàng', 'img' => 'storage/uploads/ranks/gold.svg'],
			['min' => 10001, 'max' => PHP_INT_MAX, 'rank' => 'Kim cương', 'img' => 'storage/uploads/ranks/diamond.svg']
		];
		// 2. Tính rank dựa theo điểm
		$currentRank = null;
		foreach ($ranks as $rank) {
			if ($points >= $rank['min'] && $points <= $rank['max']) {
				$currentRank = $rank;
				break;
			}
		}
		// 3. Kiểm tra rank
		if (!$currentRank) {
			return response()->json(['error' => 'Rank không tìm thấy'], 404);
		}
		// 4. Tính số điểm cần có cho rank tiếp theo và progress bar
		$nextPoints = max(0, $currentRank['max'] - $points);
		$progress = ($points - $currentRank['min']) / ($currentRank['max'] - $currentRank['min']) * 100;
		// 5. Tìm rank tiếp theo
		$nextRank = null;
		foreach ($ranks as $rank) {
			if ($rank['min'] > $currentRank['max']) {
				$nextRank = $rank;
				break;
			}
		}
		// 5.Hnagj cao nhất thì không có hạng tiếp theo
		if ($currentRank['rank'] === 'Kim cương') {
			$nextPoints = 0;
			$progress = 100;
		}
		// 6. Kiểm tra FAQ
		$faqs = [
			[
				'question' => 'Điểm tích lũy là gì?',
				'answer' => 'Điểm tích lũy là một hệ thống thưởng mà khách hàng nhận được khi thực hiện giao dịch mua hàng. Điểm này có thể được sử dụng để đổi  voucher trong lần mua hàng tiếp theo.'
			],
			[
				'question' => 'Làm thế nào để tôi có thể tích điểm?',
				'answer' => 'Bạn có thể tích điểm khi thực hiện giao dịch mua sắm tại cửa hàng hoặc trên trang web của chúng tôi. Mỗi đồng bạn chi tiêu sẽ được quy đổi thành điểm.'
			],
			[
				'question' => 'Điểm tích lũy có hết hạn không?',
				'answer' => 'Điểm không hết hạn.'
			],
			[
				'question' => 'Tôi có thể sử dụng điểm tích lũy như thế nào?',
				'answer' => 'Bạn có thể sử dụng điểm để đổi voucher tại cửa hàng  hoặc mua online của chúng tôi .'
			],
			[
				'question' => 'Tôi có thể kiểm tra số điểm của mình ở đâu?',
				'answer' => 'Bạn có thể kiểm tra số điểm tích lũy của mình trong phần tài khoản trên trang web của chúng tôi.'
			],
			[
				'question' => 'Tôi có thể chuyển điểm cho người khác không?',
				'answer' => 'Hiện tại, chương trình không cho phép chuyển nhượng điểm giữa các tài khoản.'
			],
			[
				'question' => 'Chương trình tích điểm có thay đổi không?',
				'answer' => 'Có thể. Chúng tôi sẽ thông báo trước cho khách hàng về bất kỳ thay đổi nào trong chương trình tích điểm.'
			],
			[
				'question' => 'Làm thế nào để biết điểm tích lũy của tôi đã được cập nhật chưa?',
				'answer' => 'Điểm tích lũy của bạn sẽ được cập nhật ngay lập tức sau khi giao dịch hoàn tất. Bạn có thể kiểm tra trong tài khoản của mình.'
			],
			[
				'question' => 'Có cách nào để tôi có thể tăng tốc độ tích điểm không?',
				'answer' => 'Bạn có thể tăng tốc độ tích điểm bằng cách mua sắm nhiều bên chúng tôi.'
			],
			[
				'question' => 'Tôi có thể lấy lại điểm đã sử dụng không?',
				'answer' => 'Một khi bạn đã sử dụng điểm để đổi voucher, điểm đó sẽ không được hoàn lại.'
			]
		];
		return view('clients.profile.membership', [
			'rank' => $currentRank['rank'],
			'points' => $points,
			'nextPoints' => $nextPoints,
			'nextRank' => $nextRank ? $nextRank['rank'] : 'Không có',
			'progress' => $progress,
			'img' => $currentRank['img'],
			'faqs' => $faqs
		]);
	}


	public function address()
	{
		return view('clients.profile.address');
	}

	public function settings()
	{
		return view('clients.profile.settings');
	}

	public function promotion()
	{
		return view('clients.profile.promotion');
	}

	public function updateLocation(Request $request)
	{
	}

	public function storeLocation(Request $request)
	{
	}

	public function destroyLocation(Request $request)
	{
	}
}
