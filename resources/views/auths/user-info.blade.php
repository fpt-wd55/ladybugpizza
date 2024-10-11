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
                        <label class="font-medium" for="fullname">Họ và tên </label>
                        <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}" placeholder="VD: Trần Văn A" class="mt-2 mb-2 input">
                        @error('fullname')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="date_of_birth">Ngày sinh </label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-2 mb-2 input">
                        @error('date_of_birth')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex justify-between w-full md:grid-cols-2 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="gender">Giới tính </label>
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
                        <label class="font-medium" for="avatar">Ảnh đại diện </label>
                        <input type="file" name="avatar" id="small_size" class=" mt-2 block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        @error('avatar')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex w-full grid-cols-3 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label for="province" class="min-h-5">Tỉnh/Thành phố:*</label>
                        <select name="province" id="province" class="mt-2 mb-2 input" onchange="getProvinces(event)">
                            <option value="">Chọn tỉnh/thành phố</option>
                        </select>
                        @error('province')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label for="district">Quận/Huyện:*</label>
                        <select name="district" id="district" class="mt-2 mb-2 input" onchange="getDistricts(event)">
                            <option value="">Chọn quận/huyện</option>
                        </select>
                        @error('district')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label for="ward">Phường/Xã:*</label>
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
                        <label class="font-medium" for="title">Loại địa chỉ</label>
                        <input type="text" name="title" id="title" class="mt-2 mb-2 input" placeholder="VD: Nhà riêng" value="{{ old('title') }}">
                        @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="address">Địa chỉ chi tiết</label>
                        <input type="text" name="address" id="address" class="mt-2 mb-2 input" placeholder="VD: Số 4 ngõ 2 ngách 14 đường Cầu Diễn" value="{{ old('address') }}">
                        @error('address')
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

<script>
    import {
        fetchProvinces,
        fetchDistricts,
        fetchWards
    } from "{{ asset('js/location.js') }}";

    document.addEventListener("DOMContentLoaded", function() {
        fetchProvinces().then((data) => {
            let provinces = data;
            let provinceSelect = document.getElementById("province");
            provinces.forEach((value) => {
                let option = document.createElement("option");
                option.value = value.code;
                option.text = value.name;
                provinceSelect.appendChild(option);
            });
        });

        window.getProvinces = function(event) {
            let provinceID = event.target.value;
            fetchDistricts(provinceID).then((data) => {
                let districts = data.districts;
                let districtSelect = document.getElementById("district");
                districtSelect.innerHTML = `<option value="">Chọn quận/huyện</option>`;
                districts.forEach((value) => {
                    let option = document.createElement("option");
                    option.value = value.code;
                    option.text = value.name;
                    districtSelect.appendChild(option);
                });
            });

            document.getElementById("ward").innerHTML = `<option value="">Chọn phường/xã</option>`;
        };

        window.getDistricts = function(event) {
            let districtID = event.target.value;
            fetchWards(districtID).then((data) => {
                let wards = data.wards;
                let wardSelect = document.getElementById("ward");
                wardSelect.innerHTML = `<option value="">Chọn phường/xã</option>`;
                wards.forEach((value) => {
                    let option = document.createElement("option");
                    option.value = value.code;
                    option.text = value.name;
                    wardSelect.appendChild(option);
                });
            });
        };
    });
</script>


@endsection