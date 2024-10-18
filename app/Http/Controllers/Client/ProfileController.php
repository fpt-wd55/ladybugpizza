<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Address;
use App\Models\User;
use GuzzleHttp\Client;
use App\Http\Requests\ChangeRequest;
use App\Http\Requests\InactiveRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use dvhcvn;

class ProfileController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		return view('clients.profile.index', compact('user'));
	}

	public function postUpdate(UpdateUserRequest $request)
	{
		$user = Auth::user();
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$name = $file->getClientOriginalName();
			$file->move('storage/uploads/avatars', $name);
			$user['avatar'] = $name;
		}
		$gender = null;
		if ($request->gender == 'male') {
			$gender = 1;
		} elseif ($request->gender == 'female') {
			$gender = 2;
		} elseif ($request->gender == 'other') {
			$gender = 3;
		}
		$user->fullname = $request->fullname;
		$user->email = $request->email;
		$user->phone = $request->phone;
		$user->date_of_birth = $request->date_of_birth;
		$user->gender = $gender;

		$user->save();
		return redirect()->route('client.profile.index');
	}

	public function postChangePassword(ChangeRequest $request)
	{
		$user = Auth::user();

		if (!Hash::check($request->current_password, $user->password)) {
			return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
		}

		$user->password = Hash::make($request->new_password);
		$user->save();
		return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
	}

	public function postInactive(InactiveRequest $request)
	{
		$user = Auth::user();
		if (!Hash::check($request->input('password'), $user->password)) {
			return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác']);
		}
		$user->status = 2;
		$user->save();
		Auth::logout();
		return redirect('/');
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
		return view('clients.profile.membership.index', [
			'rank' => $currentRank['rank'],
			'points' => $points,
			'nextPoints' => $nextPoints,
			'nextRank' => $nextRank ? $nextRank['rank'] : 'Không có',
			'progress' => $progress,
			'img' => $currentRank['img'],
			'faqs' => $faqs
		]);
	}

	public function membershipHistory(Request $request)
	{
        $tab = request()->query('tab');

		return view('clients.profile.membership.history', [
            'tab' => $tab
        ]);
	}

	public function address()
	{
		$user = Auth::user();
		$addresses = Address::where('user_id', $user->id)->with('user')->paginate(6);
		return view('clients.profile.address.index', compact('addresses'));
	}

	public function settings()
	{
		return view('clients.profile.settings');
	}

	public function promotion()
	{
		return view('clients.profile.promotion');
	}
	public function addLocation()
	{
		return view('clients.profile.address.add');
	}

	public function updateLocation(Request $request)
	{
	}

	public function storeLocation(AddressRequest $request)
	{
		$data = $request->all();

		$addressData = [
			'user_id' => Auth()->user()->id,
			'phone' => Auth()->user()->phone,
			'provinceCode' => $data['province'],
			'districtCode' => $data['district'],
			'wardCode' => $data['ward'],
			'detail_address' => $data['address'],
			'title' => $data['title'],
		];

		$addressNames = $this->getAddressNamesByCodes(
			$addressData['provinceCode'],
			$addressData['districtCode'],
			$addressData['wardCode']
		);

		if (is_null($addressNames['province']) || is_null($addressNames['district']) || is_null($addressNames['ward'])) {
			return back()->withErrors(['address' => 'Không thể tìm thấy tên cho mã địa chỉ.']);
		}

		$addressData['province'] = $addressNames['province'];
		$addressData['district'] = $addressNames['district'];
		$addressData['ward'] = $addressNames['ward'];

		$fullAddress = implode(', ', [
			$addressData['detail_address'],
			$addressData['ward'],
			$addressData['district'],
			$addressData['province'],
		]);

		[$lng, $lat] = $this->convertAddressToCoordinates($fullAddress);

		$addressData['lng'] = $lng;
		$addressData['lat'] = $lat;
		Address::create($addressData);

		return redirect()->route('client.profile.address')->with('success', 'Thêm địa chỉ thành công');
	}

	protected function convertAddressToCoordinates($fullAddress)
	{
		$client = new Client();
		try {
			$response = $client->get('https://nominatim.openstreetmap.org/search', [
				'query' => [
					'q' => $fullAddress,
					'format' => 'json',
				],
			]);
		} catch (\Exception $e) {
			dd($e->getMessage());
		}

		$data = json_decode($response->getBody(), true);

		if (isset($data[0])) {
			$location = $data[0];
			return [$location['lon'], $location['lat']];
		}

		return [null, null];
	}

	public function editLocation(Address $address)
	{
		return view('clients.profile.address.edit', compact('address'));
	}



	private function getAddressNamesByCodes($provinceCode, $districtCode, $wardCode)
	{
		$response = file_get_contents("https://provinces.open-api.vn/api/");
		$provinces = json_decode($response, true);
		$provinceName = null;

		foreach ($provinces as $province) {
			if ($province['code'] == $provinceCode) {
				$provinceName = $province['name'];
				break;
			}
		}

		$response = file_get_contents("https://provinces.open-api.vn/api/p/{$provinceCode}?depth=2");
		$districts = json_decode($response, true);

		if (!is_array($districts)) {
			return ['province' => $provinceName, 'district' => null, 'ward' => null];
		}

		$districtName = null;

		if (isset($districts['districts']) && is_array($districts['districts'])) {
			foreach ($districts['districts'] as $district) {
				if (isset($district['code']) && $district['code'] == $districtCode) {
					$districtName = $district['name'];
					break;
				}
			}
		}

		$response = file_get_contents("https://provinces.open-api.vn/api/d/{$districtCode}?depth=2");
		$wards = json_decode($response, true);

		if (!is_array($wards)) {
			return ['province' => $provinceName, 'district' => $districtName, 'ward' => null];
		}

		$wardName = null;

		if (isset($wards['wards']) && is_array($wards['wards'])) {
			foreach ($wards['wards'] as $ward) {
				if (isset($ward['code']) && $ward['code'] == $wardCode) {
					$wardName = $ward['name'];
					break;
				}
			}
		}

		return [
			'province' => $provinceName,
			'district' => $districtName,
			'ward' => $wardName,
		];
	}



	public function destroyLocation(Request $request)
	{
		$client = new Client();
	}

}
