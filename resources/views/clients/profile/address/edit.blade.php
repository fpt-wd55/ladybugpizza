@extends('layouts.client')

@section('title', 'Sửa địa chỉ')

@section('content')
    <div class="card my-8 md:mx-24 lg:mx-32 p-4 md:p-8 transition">
        <div class="mb-8">
            <h3 class="font-semibold uppercase ">Sửa địa chỉ</h3>
        </div>
        <form action="{{ route('client.profile.update-location', $address) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-4 mb-4 grid-cols-3">
                <div class="col-span-3">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Loại
                        địa chỉ</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $address->title) }}"
                        class="input" placeholder="VD: Nhà riêng">
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
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Địa
                        chỉ chi tiết</label>
                    <input type="text" name="address" id="address" class="mt-2 mb-2 input"
                        placeholder="VD: Số 4 ngõ 2 ngách 14 đường Cầu Diễn"
                        value="{{ old('address', $address->detail_address) }}">
                    @error('address')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="button-red">
                    Cập Nhật
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
            const provinceSelect = $('#province');
            const districtSelect = $('#district');
            const wardSelect = $('#ward');

            // Set initial province
            provinceSelect.append(new Option('Hà Nội', '01')).val('01').prop('disabled', false);

            // Load districts when a province is selected
            const provinceCode = '01'; // Mã cố định của Hà Nội
            districtSelect.empty().append(new Option('Chọn Quận/Huyện', '')).prop('disabled', true);

            if (provinceCode) {
                $.getJSON(`/api/districts/${provinceCode}`, function(data) {
                    districtSelect.prop('disabled', false);
                    data.forEach(district => {
                        districtSelect.append(new Option(district.name, district.code));
                    });

                    // Set initial district
                    const initialDistrict = '{{ $address->district }}';
                    districtSelect.val(initialDistrict);

                    // Load wards when a district is selected
                    const districtCode = initialDistrict;
                    loadWards(districtCode);

                    // Event listener for district change
                    districtSelect.on('change', function() {
                        const selectedDistrictCode = $(this).val();
                        loadWards(selectedDistrictCode);
                    });
                });
            }

            function loadWards(districtCode) {
                wardSelect.empty().append(new Option('Chọn Phường/Xã', '')).prop('disabled', true);

                if (districtCode) {
                    $.getJSON(`/api/wards/${districtCode}`, function(data) {
                        wardSelect.prop('disabled', false);
                        data.forEach(ward => {
                            wardSelect.append(new Option(ward.name, ward.code));
                        });

                        // Set initial ward if it's the initial load
                        const initialWard = '{{ $address->ward }}';
                        if (districtCode === '{{ $address->district }}') {
                            wardSelect.val(initialWard);
                        }
                    });
                }
            }
        });
    </script>

@endsection
