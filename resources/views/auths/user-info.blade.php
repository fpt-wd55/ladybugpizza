@extends('layouts.shared')

@section('title', 'Thu thập thông tin người dùng')

@section('content')
    <div class="w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4 transition">
        <div class="md:grid gap-4 card">
            <div class=" p-4 md:p-6 lg:p-8">
                <div class="mb-4">
                    <div class="mb-4 font-semibold text-lg">
                        Cập nhật thông tin
                    </div>
                </div>
                <form action="{{ route('auth.post-user-info') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="md:flex justify-between w-full grid-cols-2 gap-4">
                        <div class="mb-4 py-4 w-full">
                            <label class="font-medium" for="fullname">Họ và tên <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                                placeholder="VD: Trần Văn A" class="mt-2 mb-2 input">
                            @error('fullname')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4 py-4 w-full">
                            <label class="font-medium" for="date_of_birth">Ngày sinh <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                                class="mt-2 mb-2 input">
                            @error('date_of_birth')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex justify-between w-full md:grid-cols-2 gap-4">
                        <div class="mb-4 py-4 w-full">
                            <label class="font-medium" for="gender">Giới tính <span
                                    class="text-red-500">*</span></label>
                            <select name="gender" id="gender" class="mt-2 mb-2 input" value="{{ old('gender') }}">
                                <option value="">Chọn giới tính</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                                <option value="3">Khác</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4 py-4 w-full">
                            <label class="font-medium" for="avatar">Ảnh đại diện</label>
                            <input type="file" name="avatar" id="small_size"
                                class=" mt-2 block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none ">
                            @error('avatar')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex w-full grid-cols-3 gap-4">
                        <div class="mb-4 py-4 w-full">
                            <label for="province" class="min-h-5">Tỉnh/Thành phố: <span
                                    class="text-red-500">*</span></label>
                            <select name="province" id="province" class="mt-2 mb-2 input" disabled>
                            </select>
                            @error('province')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4 py-4 w-full">
                            <label for="district">Quận/Huyện: <span class="text-red-500">*</span></label>
                            <select name="district" id="district" class="mt-2 mb-2 input">
                                <option value="">Chọn quận/huyện</option>
                            </select>
                            @error('district')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4 py-4 w-full">
                            <label for="ward">Phường/Xã: <span class="text-red-500">*</span></label>
                            <select name="ward" id="ward" class="mt-2 mb-2 input">
                                <option value="">Chọn phường/xã</option>
                            </select>
                            @error('ward')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-between w-full grid-cols-2 gap-4">
                        <div class="mb-4 py-4 w-full">
                            <label class="font-medium" for="detail_address">Địa chỉ chi tiết <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="detail_address" id="detail_address" class="mt-2 mb-2 input"
                                placeholder="VD: Số 4 ngõ 2 ngách 14 đường Cầu Diễn" value="{{ old('detail_address') }}">
                            @error('detail_address')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button class="bg-red-600 flex items-center justify-center button-red w-28">
                            Hoàn tất
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load provinces on page load
            // $.getJSON('/api/provinces', function(data) {
            //     const provinceSelect = $('#province');
            //     data.forEach(province => {
            //         provinceSelect.append(new Option(province.name, province.code));
            //     });
            // });

            // Cố định Hà Nội
            const provinceSelect = $('#province');
            provinceSelect.append(new Option('Hà Nội', '01')).val('01').prop('disabled', false);

            // Load districts when a province is selected
            // $('#province').change(function() {
            const provinceCode = '01'; // Mã cố định của Hà Nội
            const districtSelect = $('#district');
            districtSelect.empty().append(new Option('Chọn Quận/Huyện', '')).prop('disabled', true);

            if (provinceCode) {
                $.getJSON(`/api/districts/${provinceCode}`, function(data) {
                    districtSelect.prop('disabled', false);
                    data.forEach(district => {
                        districtSelect.append(new Option(district.name, district.code));
                    });
                });
            }

            // Reset wards
            $('#ward').empty().append(new Option('Chọn Phường/Xã', '')).prop('disabled', true);
            // });

            // Load wards when a district is selected
            $('#district').change(function() {
                const districtCode = $(this).val();
                const wardSelect = $('#ward');
                wardSelect.empty().append(new Option('Chọn Phường/Xã', '')).prop('disabled', true);

                if (districtCode) {
                    $.getJSON(`/api/wards/${districtCode}`, function(data) {
                        wardSelect.prop('disabled', false);
                        data.forEach(ward => {
                            wardSelect.append(new Option(ward.name, ward.code));
                        });
                    });
                }
            });
        });
    </script>

@endsection
