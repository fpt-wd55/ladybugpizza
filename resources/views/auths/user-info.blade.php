@extends('layouts.shared')

@section('title', 'Thu thập thông tin người dùng')

@section('content')

<div class="container w-full md:w-[920px] h-[629px] md:mx-auto my-16 p-4">
    <div class="md:grid gap-4 card">
        <div class=" p-4 md:p-6 lg:p-8">
            <div class="mb-4">
                <div class="mb-4 font-semibold text-lg">
                    Cập nhật thông tin
                </div>
            </div>
            <form action="{{route('auth.post-user-info')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="md:flex justify-between w-full grid-cols-2 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="fullname">Họ và tên </label>
                        <input type="text" name="fullname" id="fullname" class="mt-2 mb-2 input">
                        @error('fullname')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="date_of_birth">Ngày sinh </label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="mt-2 mb-2 input">
                        @error('date_of_birth')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex justify-between w-full md:grid-cols-2 gap-4">
                    <div class="mb-4 py-4 w-full">
                        <label class="font-medium" for="gender">Giới tính </label>
                        <select name="gender" id="gender" class="mt-2 mb-2 input">
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
                        <input type="file" name="avatar" id="avatar" class="mt-2 mb-2 input filepond">
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
                        <input type="text" name="title" id="title" class="mt-2 mb-2 input">
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        </div>
                    <div class="mb-4 py-4 w-full">
                    <label class="font-medium" for="address">Địa chỉ chi tiết</label>
                    <input type="text" name="address" id="address" class="mt-2 mb-2 input">
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
    fetch('https://provinces.open-api.vn/api/')
        .then(response => response.json())
        .then(data => {
            let provinces = data
            provinces.map(value => document.getElementById('province').innerHTML += `<option value="${value.code}">${value.name}</option>`)
            })
        .catch(error => {
            console.error('Lỗi khi gọi API:', error);
        })

    function fetchDistricts(provinceID){
        fetch(`https://provinces.open-api.vn/api/p/${provinceID}?depth=2`)
        .then(response => response.json())
        .then(data => {
            let districts = data.districts
            document.getElementById('district').innerHTML = `<option value="">Chọn quận/huyện</option>`
            if (districts!==undefined) {
                districts.map(value => document.getElementById('district').innerHTML += `<option value="${value.code}">${value.name}</option>`)
            }
            })
        .catch(error => {
            console.error('Lỗi khi gọi API:', error);
        })
    }

    function fetchWards(districtID){
        fetch(`https://provinces.open-api.vn/api/d/${districtID}?depth=2`)
        .then(response => response.json())
        .then(data => {
            let wards = data.wards
            document.getElementById('ward').innerHTML = `<option value="">Chọn phường/xã</option>`
            if (wards!==undefined) {
                wards.map(value => document.getElementById('ward').innerHTML += `<option value="${value.code}">${value.name}</option>`)
            }
            })
        .catch(error => {
            console.error('Lỗi khi gọi API:', error);
        })
    }

    function getProvinces(event) {
        fetchDistricts(event.target.value);
        document.getElementById('ward').innerHTML = `<option value="">Chọn phường/xã</option>`
    }

    function getDistricts(event) {
        fetchWards(event.target.value);
    }
</script>


@endsection
