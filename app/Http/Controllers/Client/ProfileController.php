<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Promotion;
use App\Models\PromotionUser;
use App\Http\Requests\ChangeRequest;
use App\Http\Requests\InactiveRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Auth as MailAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

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
		$old_avatar = $user->avatar;
		// Kiểm tra xem người dùng có tải lên avatar không
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$name = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension();
		}

		// Cập nhật thông tin người dùng  
		$dataUpdate = [
			'fullname' => $request->fullname,
			'email' => $request->email,
			'phone' => $request->phone,
			'date_of_birth' => $request->date_of_birth,
			'gender' => $request->gender,
			'avatar' => $name ?? $user->avatar,
		];

		if ($user->update($dataUpdate)) {
			// Xu ly upload anh va xoa anh cu
			if ($request->hasFile('avatar')) {
				$file->move(storage_path('app/public/uploads/avatars'), $name);

				if ($old_avatar != null) {
					$is_default_avatar = false;
					for ($i = 1; $i <= 20; $i++) {
						if ($old_avatar == 'user-default-' . $i . '.png') {
							$is_default_avatar = true;
							break;
						}
					}
				}

				if (!$is_default_avatar) {
					try {
						unlink(storage_path('app/public/uploads/avatars/' . $old_avatar));
					} catch (\Throwable $th) {
						return redirect()->route('client.profile.index')->with('success', 'Cập nhật thông tin thành công');
					}
				}
			}
			return redirect()->route('client.profile.index')->with('success', 'Cập nhật thông tin thành công');
		}
		return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
	}

	public function postChangePassword(ChangeRequest $request)
	{
		$user = Auth::user();

		if (!Hash::check($request->current_password, $user->password)) {
			return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
		}

		$user->password = Hash::make($request->new_password);
		if ($user->save()) {
			$userSetting = $user->setting;
			if ($userSetting->email_order) {
				//  Gửi email thông báo thay đổi mật khẩu
				$subject = 'Thông báo thay đổi mật khẩu';
				Mail::to($user->email)->send(new MailAuth(null, $subject, 'mails.change_password'));
			}

			return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
		}

		return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
	}


	public function postInactive(InactiveRequest $request)
	{
		$user = Auth::user();

		// Debug: Kiểm tra email
		if (strtolower($request->input('confirm_email')) !== strtolower($user->email)) {
			return redirect()->back()->with('error', 'Vô hiệu hóa tài khoản không thành công! Vui lòng kiểm tra lại email.');
		}

		// Debug: Kiểm tra lưu trạng thái
		$user->status = 2;
		if ($user->save()) {
			Auth::logout();
			return redirect()->route('client.home')->with('success', 'Tài khoản của bạn đã bị vô hiệu hóa');
		}

		return redirect()->route('client.home')->with('error', 'Đã có lỗi xảy ra');
	}

	public function address()
	{
		$redirectHome = $this->checkUser();
		if ($redirectHome) {
			return $redirectHome;
		}
		$addresses = Address::where('user_id', Auth::user()->id)
			->with('user')
			->orderBy('is_default', 'desc')
			->paginate(5);

		foreach ($addresses as $address) {
			$address->province = Province::find($address->province);
			$address->district = District::find($address->district);
			$address->ward = Ward::find($address->ward);
		}
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
			$settings->save();

			return redirect()->back()->with('success', 'Cài đặt đã được cập nhật!');
		}

		return redirect()->back()->with('error', 'Thay đổi trạng thái thất bại');
	}

	public function promotion()
	{
		$myCodes = PromotionUser::where('user_id', Auth::user()->id)
			->whereHas('promotion', function ($query) {
				$query->where('end_date', '>=', now());
			})
			->with('promotion')->get();


		$countMyCodes = PromotionUser::where('user_id', Auth::user()->id)
			->whereHas('promotion', function ($query) {
				$query->where('end_date', '>=', now());
			})
			->count();

		$userRankId = Auth::user()->membership->rank_id;

		$redeemCodes = Promotion::where('status', 1)
			->where('quantity', '>', 0)
			->where('end_date', '>=', now())
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

	public function editLocation(Address $address)
	{
		$province = Province::find($address->province);
		$districts = $province->districts;
		$district = District::find($address->district);
		$wards = $district->wards;
		return view('clients.profile.address.edit', compact('address', 'province', 'districts', 'wards'));
	}

	public function updateLocation(AddressRequest $request, Address $address)
	{
		$data = $request->all();
		$addressData = [
			'user_id' => Auth()->user()->id,
			'phone' => Auth()->user()->phone,
			'province' => $data['province'],
			'district' => $data['district'],
			'ward' => $data['ward'],
			'detail_address' => $data['address'],
			'title' => $data['title'],
		];
		$address->update($addressData);

		return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công');
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
}
