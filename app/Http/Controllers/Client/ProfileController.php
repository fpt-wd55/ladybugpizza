<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Address;
use App\Models\Promotion;
use App\Models\PromotionUser;
use App\Models\User;
use GuzzleHttp\Client;
use App\Http\Requests\ChangeRequest;
use App\Http\Requests\InactiveRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Faq;
use App\Models\MembershipRank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use dvhcvn;
use Illuminate\Support\Facades\Storage;
use App\Models\UserSetting;

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

		// Khởi tạo một mảng chứa các trường cần cập nhật
		$data = [];

		// Kiểm tra xem người dùng có tải lên avatar không
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$name = $file->getClientOriginalName();
			$file->move('storage/uploads/avatars', $name);
			$data['avatar'] = $name;
		}

		// Xử lý giới tính
		$gender = null;
		if ($request->gender == 'male') {
			$gender = 1;
		} elseif ($request->gender == 'female') {
			$gender = 2;
		} elseif ($request->gender == 'other') {
			$gender = 3;
		}

		// Cập nhật thông tin người dùng
		$data['fullname'] = $request->fullname;
		$data['email'] = $request->email;
		$data['phone'] = $request->phone;
		$data['date_of_birth'] = $request->date_of_birth;
		$data['gender'] = $gender;

		if (!$user->update($data)) {
			return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
		}

		return redirect()->route('client.profile.index')->with('success', 'Cập nhật thông tin thành công');
	}


	public function postChangePassword(ChangeRequest $request)
	{
		$user = Auth::user();

		if (!Hash::check($request->current_password, $user->password)) {
			return back()->with('current_password', 'Mật khẩu hiện tại không đúng');
		}

		$user->password = Hash::make($request->new_password);
		if (!$user->save()) {
			return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
		}

		return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
	}

	public function postInactive(InactiveRequest $request)
	{
		$user = Auth::user();

		if (!Hash::check($request->input('password'), $user->password)) {
			return redirect()->back()->with('error', 'Mật khẩu không chính xác');
		}

		$user->status = 2;
		if (!$user->save()) {
			Auth::logout();
			return redirect()->route('client.home')->with('error', 'Đã có lỗi xảy ra');
		}

		return redirect()->route('client.home')->with('success', 'Tài khoản của bạn đã bị vô hiệu hóa');
	}

	public function membership()
	{
		$membership = Auth::user()->membership;
		$points = $membership->total_spent;

		$ranks = MembershipRank::all();

		// 2. Tính rank dựa theo điểm
		$currentRank = null;

		foreach ($ranks as $rank) {
			if ($points >= $rank->min_points && ($rank->max_points === null || $points <= $rank->max_points)) {
				$currentRank = $rank;
				break;
			}
		}

		// 3. Kiểm tra rank
		if (!$currentRank) {
			return back()->with('error', 'Không tìm thấy hạng');
		}

		// 4. Tính số điểm cần có cho rank tiếp theo và progress bar
		// Tính số điểm cần có cho rank tiếp theo và progress bar
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

		// 5. Hạng cao nhất thì không có hạng tiếp theo
		if ($currentRank->name === 'Kim cương') {
			$nextPoints = 0;
			$progress = 100;
		}

		// 6. Kiểm tra FAQ
		$faqs = Faq::all();

		return view('clients.profile.membership.index', [
			'rank' => $currentRank->name,
			'points' => $points,
			'nextPoints' => $nextPoints,
			'nextRank' => $nextRank ? $nextRank->name : 'Không có',
			'progress' => $progress,
			'img' => $currentRank->icon,
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
		// Lấy thông tin cài đặt của người dùng hiện tại
		$userSetting = UserSetting::where('user_id', auth()->id())->first();

		// Nếu không tìm thấy cài đặt, có thể tạo mới hoặc xử lý theo ý bạn
		if (!$userSetting) {
			$userSetting = new UserSetting(); // Tạo một đối tượng mới nếu không tìm thấy
			$userSetting->email_order = true; // Giá trị mặc định
			$userSetting->email_promotions = true; // Giá trị mặc định
			$userSetting->email_security = true; // Giá trị mặc định
			$userSetting->push_order = true; // Giá trị mặc định
			$userSetting->push_promotions = true; // Giá trị mặc định
			$userSetting->push_security = true; // Giá trị mặc định
		}

		return view('clients.profile.settings', compact('userSetting'));
	}
	public function updateStatus(Request $request, string $id)
	{
		// Tìm cài đặt dựa trên ID
		$settings = UserSetting::query()->findOrFail($id);

		if ($settings) {
			// Cập nhật các giá trị dựa trên request
			$settings->email_order = $request->has('email_order') ? 1 : 0;
			$settings->email_promotions = $request->has('email_promotions') ? 1 : 0;
			$settings->email_security = $request->has('email_security') ? 1 : 0;
			$settings->push_order = $request->has('push_order') ? 1 : 0;
			$settings->push_promotions = $request->has('push_promotions') ? 1 : 0;
			$settings->push_security = $request->has('push_security') ? 1 : 0;

			// Lưu cài đặt
			$settings->save();

			// Trả về thông báo thành công
			return redirect()->back()->with('success', 'Cài đặt đã được cập nhật!');
		}

		// Trả về thông báo lỗi nếu không tìm thấy cài đặt
		return redirect()->back()->with('error', 'Thay đổi trạng thái thất bại');
	}

	public function promotion()
	{

		$tab = request()->query('tab', 'my-code');

		if ($tab === 'my-code') {

			$promotions = PromotionUser::where('user_id', Auth::user()->id)
				->with('promotion')
				->paginate(10);
		} elseif ($tab == 'redeem-code') {

			$promotions = Promotion::where('status', 1)
				->where('is_global', 1)
				->when(request('rank_id'), function ($query) {
					return $query->where('rank_id', request('rank_id'));
				})
				->paginate(10);
		} else {

			$promotions = collect();

		}

		// hoir chatgpt lấy ra số lượng mã giảm giá của tôi

		// $countMyPromotion = 
		return view('clients.profile.promotion', compact('promotions', 'tab'));
	}
  
	public function redeemPromotion($id)
	{	
		// code ở đây

		// Kiểm tra xem mã giảm giá có tồn tại không + còn hạn không + còn số lượng không

		// Lưu mã giảm giá vào bảng promotion_users và trừ điểm của người dùng + trừ số lượng của mã giảm giá nếu đủ điều kiện

		// Điều hướng và thông báo thành công hoặc thất bại

		return back()->with('success', 'Mã giảm giá đã được sử dụng');
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
