<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Promotion;
use App\Models\PromotionUser;
use GuzzleHttp\Client;
use App\Http\Requests\ChangeRequest;
use App\Http\Requests\InactiveRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Faq;
use App\Models\Log;
use App\Models\Membership;
use App\Models\MembershipRank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
	public function index()
	{
		$redirectHome = $this->checkUser();
		if ($redirectHome) {
			return $redirectHome;
		}
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
			return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
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



	public function address()
	{
		$redirectHome = $this->checkUser();
		if ($redirectHome) {
			return $redirectHome;
		}
		$user = Auth::user();
		$addresses = Address::where('user_id', $user->id)
			->with('user')
			->orderBy('is_default', 'desc')
			->paginate(6);
		return view('clients.profile.address.index', compact('addresses'));
	}

	public function settings()
	{
		$redirectHome = $this->checkUser();
		if ($redirectHome) {
			return $redirectHome;
		}
		// Lấy thông tin cài đặt của người dùng hiện tại
		$userSetting = UserSetting::where('user_id', auth()->id())->first();

		// Nếu không tìm thấy cài đặt, tạo mới và lưu vào cơ sở dữ liệu
		if (!$userSetting) {
			$userSetting = new UserSetting();
			$userSetting->user_id = auth()->id();
			$userSetting->email_order = true;
			$userSetting->email_promotions = true;
			$userSetting->email_security = true;
			$userSetting->push_order = true;
			$userSetting->push_promotions = true;
			$userSetting->push_security = true;

			// Lưu vào cơ sở dữ liệu
			$userSetting->save();
		}

		return view('clients.profile.settings', compact('userSetting'));
	}
	public function updateStatus(Request $request, string $id)
	{
		$settings = UserSetting::query()->findOrFail($id);
		if ($settings) {
			$settings->email_order = $request->has('email_order') ? 1 : 0;
			$settings->email_promotions = $request->has('email_promotions') ? 1 : 0;
			$settings->email_security = $request->has('email_security') ? 1 : 0;
			$settings->push_order = $request->has('push_order') ? 1 : 0;
			$settings->push_promotions = $request->has('push_promotions') ? 1 : 0;
			$settings->push_security = $request->has('push_security') ? 1 : 0;
			$settings->save();

			return redirect()->back()->with('success', 'Cài đặt đã được cập nhật!');
		}

		return redirect()->back()->with('error', 'Thay đổi trạng thái thất bại');
	}

	public function promotion()
	{
		$myCodes = PromotionUser::where('user_id', Auth::user()->id)
			->with('promotion')->get();

		$countMyCodes = PromotionUser::where('user_id', Auth::user()->id)->count();

		$userRankId = Auth::user()->membership->rank_id;

		$redeemCodes = Promotion::where('status', 1)
			->where('quantity', '>', 0)
			->where(function ($query) use ($userRankId) {
				$query->where('is_global', '!=', 2)
					->orWhere('rank_id', $userRankId);
			})->get();

		$currentPoint = Auth::user()->membership->points ?? 0;

		return view('clients.profile.promotion', [
			'myCodes' => $myCodes,
			'countMyCodes' => $countMyCodes,
			'redeemCodes' => $redeemCodes,
			'currentPoint' => $currentPoint,
		]);
	}

	public function redeemPromotion($id)
	{
		$user = Auth::user();
		$promotion = Promotion::findOrFail($id);

		if ($user->membership->points < $promotion->points) {
			return back()->with('error', 'Bạn không đủ điểm để đổi mã giảm giá này.');
		}

		if ($promotion->quantity <= 0) {
			return back()->with('error', 'Mã giảm giá đã hết.');
		}

		// kiểm tra xem người dùng đã đổi mã giảm giá này chưa
		$hasRedeemed = PromotionUser::where('user_id', $user->id)
			->where('promotion_id', $promotion->id)
			->exists();

		if ($hasRedeemed) {
			return back()->with('error', 'Bạn đã đổi mã giảm giá này rồi.');
		}

		// kiểm tra xem mã giảm giá còn hiệu lực không
		if ($promotion->end_date < Carbon::now()) {
			return back()->with('error', 'Mã giảm giá đã hết hạn.');
		}

		// Transaction để đảm bảo tính toàn vẹn
		try {
			DB::transaction(function () use ($user, $promotion) {
				// Cập nhật điểm cho người dùng
				$user->membership->decrement('points', $promotion->points);

				// Giảm số lượng mã giảm giá
				$promotion->decrement('quantity');

				// Lưu thông tin người dùng đã đổi mã giảm giá
				PromotionUser::create([
					'user_id' => $user->id,
					'promotion_id' => $promotion->id,
				]);
			});
		} catch (\Exception $e) {
			return back()->with('error', 'Đã có lỗi xảy ra.');
		}

		return back()->with('success', 'Bạn đã đổi mã giảm giá thành công');
	}


	public function addLocation()
	{
		return view('clients.profile.address.add');
	}

	public function updateLocation(AddressRequest $request, Address $address)
	{
		$data = $request->all();
		// dd($data);
		$addressData = [
			'user_id' => Auth()->user()->id,
			'phone' => Auth()->user()->phone,
			'province' => $data['province'],
			'district' => $data['district'],
			'ward' => $data['ward'],
			'detail_address' => $data['address'],
			'title' => $data['title'],
		];
		$fullAddress = implode(', ', [
			$addressData['detail_address'],
			$addressData['ward'],
			$addressData['district'],
			$addressData['province'],
		]);
		$address->update($addressData);

		return redirect()->route('client.profile.address')->with('success', 'Cập nhật địa chỉ thành công');
	}

	public function storeLocation(AddressRequest $request)
	{
		$data = $request->all();
		
		$addressData = [
			'user_id' => Auth()->user()->id, 
			'province' => $data['province'],
			'district' => $data['district'],
			'ward' => $data['ward'],
			'detail_address' => $data['address'],
			'title' => $data['title'],
		]; 

		Address::create($addressData);

		return redirect()->route('client.profile.address')->with('success', 'Thêm địa chỉ thành công');
	}

	// protected function convertAddressToCoordinates($fullAddress)
	// {
	// 	$client = new Client();
	// 	try {
	// 		$response = $client->get('https://nominatim.openstreetmap.org/search', [
	// 			'query' => [
	// 				'q' => $fullAddress,
	// 				'format' => 'json',
	// 			],
	// 		]);
	// 	} catch (\Exception $e) {
	// 		dd($e->getMessage());
	// 	}

	// 	$data = json_decode($response->getBody(), true);

	// 	if (isset($data[0])) {
	// 		$location = $data[0];
	// 		return [$location['lon'], $location['lat']];
	// 	}

	// 	return [null, null];
	// }

	public function editLocation(Address $address)
	{
		return view('clients.profile.address.edit', compact('address'));
	}

	public function deleteLocation(Address $address)
	{

		$id = $address['id'];

		if (Address::destroy($id)) {
			return redirect()->back()->with('success', 'Xóa địa thành công');
		} else {
			return redirect()->back()->with('error', 'Xóa địa chỉ thất bại');
		}
	}
	public function setDefaultAddress(Address $address)
	{
		Address::where('user_id', $address->user_id)->update(['is_default' => 0]);

		$address->is_default = 1;
		$address->save();

		return redirect()->back()->with('success', 'Địa chỉ mặc định đã được cập nhật.');
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
}
