@extends('layouts.admin')
@section('title', 'Giờ mở cửa')
@section('content')
    {{ Breadcrumbs::render('admin.opening-hours.index') }}
    <div class="relative mt-5 min-h-screen overflow-hidden bg-white shadow sm:rounded-lg">
        <form action="{{ route('admin.opening-hours.update') }}" method="post">
            @csrf
            @method('PUT')
            <div
                class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                <div
                    class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <h2 class="me-7 text-base font-medium text-gray-700">
                        Giờ mở cửa
                    </h2>
                </div>
                <div
                    class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                    <button type="submit" class="button-blue">
                        Cập nhật
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500">
                    <thead class="bg-gray-50 uppercase text-gray-700">
                        <tr>
                            <th class="px-4 py-3" scope="col">Thời gian</th>
                            <th class="px-4 py-3" scope="col">Giờ mở cửa</th>
                            <th class="px-4 py-3" scope="col">Giờ đóng cửa</th>
                            <th class="px-4 py-3" scope="col">Mở cửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($openingHours as $item)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $item->name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    <select class="select" name="opening_hours[{{ $item->day_of_week }}][open_time]">
                                        <option disabled selected>Giờ mở cửa</option>
                                        @foreach ($hours as $hour)
                                            <option {{ $item->open_time == $hour ? 'selected' : '' }}
                                                value="{{ $hour }}">
                                                {{ $hour }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opening_hours.' . $item->day_of_week . '.open_time')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    <select class="select" name="opening_hours[{{ $item->day_of_week }}][close_time]">
                                        <option disabled selected>Giờ đóng cửa</option>
                                        @foreach ($hours as $hour)
                                            <option {{ $item->close_time == $hour ? 'selected' : '' }}
                                                value="{{ $hour }}">
                                                {{ $hour }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opening_hours.' . $item->day_of_week . '.close_time')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="opening_hours[{{ $item->day_of_week }}][is_open]"
                                            value="1" {{ $item->is_open ? 'checked' : '' }} class="sr-only peer">
                                        <span class="button-toggle"></span>
                                    </label>
                                    @error('opening_hours.' . $item->day_of_week . '.is_open')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </td>
                            </tr>
                        @empty
                            <td class="py-4 text-center text-base" colspan="6">
                                <div class="flex h-80 w-full flex-col items-center justify-center rounded-lg bg-white p-6">
                                    @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                    <p class="mt-4 text-sm text-gray-500">Dữ liệu trống</p>
                                </div>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
