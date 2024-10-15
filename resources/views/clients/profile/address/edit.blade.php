@extends('layouts.client')

@section('title', 'Sửa địa chỉ')

@section('content')
    <div class="card my-8 md:mx-24 lg:mx-32 p-4 md:p-8 transition">
        <div class="mb-8">
            <h3 class="font-semibold uppercase ">Sửa địa chỉ</h3>
        </div>
        <form action="{{ route('client.profile.post-location') }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="col-span-2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại
                        địa chỉ</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $address->title) }}"
                        class="input" placeholder="VD: Nhà riêng">
                    @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tỉnh/Thành
                        phố:*</label>
                    <select name="province" id="province" class="input" onchange="getProvinces(event)">
                        <option value="">Chọn tỉnh/thành phố</option>
                        <option value="{{ $address['province'] }}" selected>{{ $address['province'] }}</option>
                    </select>
                    @error('province')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="district"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quận/Huyện:*</label>
                    <select name="district" id="district" class="input" onchange="getDistricts(event)">
                        <option value="">Chọn quận/huyện</option>
                        <option value="{{ $address['district'] }}" selected>{{ $address['district'] }}</option>
                    </select>
                    </select>
                    @error('district')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="ward"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Xã/Phường:*</label>
                    <select name="ward" id="ward" class="input">
                        <option value="">Chọn xã/phường</option>
                    </select>
                    @error('ward')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa
                        chỉ
                        chi tiết</label>
                    <textarea type="text" name="address" id="address" class="text-area"
                        placeholder="VD: Số 4 ngõ 2 ngách 14 đường Cầu Diễn">{{ old('address', $address->detail_address) }}</textarea>
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
