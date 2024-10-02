@extends('layouts.client')

@section('title', 'Tài khoản và bảo mật')

@section('content')
    <div class="md:mx-24 lg:mx-32 min-h-screen p-4 md:p-8 transition">
        <div class="lg:flex">
            @include('clients.profile.sidebar')

            <div class="card p-4 md:p-8 w-full min-h-screen">
                <h3 class="font-semibold uppercase mb-8">hồ sơ của tôi</h3>
                <div class="grid grid-cols-1 lg:grid-cols-3">

                    <div class="col-span-1 flex flex-col items-center mb-8 gap-4">
                        <img class="img-circle img-lg"
                            src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : asset('storage/uploads/avatars/' . (Auth::user()->avatar ?? 'user-default.png')) }}"
                            alt="">
                        <input type="file" id="avatar" class="hidden">
                        <label for="avatar" class="button-red cursor-pointer">
                            Chọn ảnh
                        </label>
                    </div>

                    <div class="col-span-2">

                        {{-- update info form --}}
                        <form action="#" class="mb-8">
                            @csrf
                            @method('PUT')
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Tên tài khoản:</label>
                                <span class="badge-red">quandohong28</sp>
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Họ và tên:</label>
                                <input type="text" class="input">
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Email:</label>
                                <input type="text" class="input">
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Số điện thoại:</label>
                                <input type="text" class="input">
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <p class="text-sm font w-32 font-medium">Giới tính:</p>
                                <div class="flex items-center gap-4 text-sm">
                                    <label for="male">
                                        <input type="radio" name="gender" value="male" id="male"
                                            class="input-radio">
                                        Nam
                                    </label>
                                    <label for="female">
                                        <input type="radio" name="gender" value="female" id="female"
                                            class="input-radio">
                                        Nữ
                                    </label>
                                    <label for="other">
                                        <input type="radio" name="gender" value="other" id="other"
                                            class="input-radio">
                                        Khác
                                    </label>
                                </div>
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font-medium w-32">Ngày sinh:</label>
                                <input type="date" class="input">
                            </div>
                            <div class="mb-6 flex justify-end">
                                <button type="submit" class="button-red">
                                    @svg('tabler-cloud-upload', 'icon-sm me-2')
                                    Cập nhật
                                </button>
                            </div>
                        </form>

                        {{-- Change password form --}}
                        <form action="#" class="mb-8">
                            @csrf
                            @method('PUT')
                            <p class="title">ĐỔI MẬT KHẨU</p>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Mật khẩu cũ:</label>
                                <input type="password" class="input">
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Mật khẩu mới:</label>
                                <input type="password" class="input">
                            </div>
                            <div class="mb-6 flex items-center gap-8">
                                <label class="text-sm font w-32 font-medium">Nhập lại mật khẩu:</label>
                                <input type="password" class="input">
                            </div>
                            <div class="mb-6 flex justify-end">
                                <button type="submit" class="button-red">
                                    @svg('tabler-cloud-upload', 'icon-sm me-2')
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </form>

                        {{-- Form inactive account --}}
                        <form action="#" class="mb-8">
                            @csrf
                            @method('PUT')
                            <p class="title">KHOÁ TÀI KHOẢN</p>
                            <p class="text-sm mb-4">Tài khoản của bạn sẽ bị khoá nhưng thông tin của bạn vẫn được lưu trữ,
                                bạn có
                                thể khôi phục lại bất kỳ lúc nào</p>
                            <p class="text-sm mb-4">Chúng tôi sẽ yêu cầu mật khẩu để xác nhận hành động này</p>
                            <div class="mb-6 flex justify-end">
                                <button type="submit" class="button-red">
                                    @svg('tabler-lock', 'icon-sm me-2')
                                    Huỷ kích hoạt
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
