@extends('layouts.client')

@section('title', 'Thêm địa chỉ')
@section('content')
    <div class="card my-8 md:mx-24 lg:mx-32 p-4 md:p-8 transition">
        <div class="mb-8">
            <h3 class="font-semibold uppercase ">Thêm địa chỉ</h3>
        </div>
        <form action="{{ route('client.profile.post-location') }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-4 grid-cols-3">
                <div class="col-span-3">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại
                        địa chỉ</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="input"
                        placeholder="VD: Nhà riêng">
                    @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="province" class="min-h-5">Tỉnh/Thành phố:*</label>
                    <select name="province" id="province" class="mt-2 mb-2 input" disabled>
                    </select>
                    @error('province')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="district">Quận/Huyện:*</label>
                    <select name="district" id="district" class="mt-2 mb-2 input">
                    </select>
                    @error('district')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="ward">Phường/Xã:*</label>
                    <select name="ward" id="ward" class="mt-2 mb-2 input">
                    </select>
                    @error('ward')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-3">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa
                        chỉ
                        chi tiết</label>
                    <textarea type="text" name="address" id="address" value="{{ old('address') }}" class="text-area"
                        placeholder="VD: Số 30 Trịnh Văn Bô"></textarea>
                    @error('address')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="button-red">
                    Thêm mới
                </button>
                <a href="{{ route('client.profile.address') }}" class="button-dark">
                    Quay lại
                </a>
            </div>
        </form>
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
