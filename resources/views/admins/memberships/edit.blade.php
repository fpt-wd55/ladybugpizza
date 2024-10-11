@extends('layouts.admin')
@section('title', 'Điểm thành viên | chi tiết')
@section('content')
{{ Breadcrumbs::render('admin.memberships.edit') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3 p-4">
            <a href="{{ route('admin.categories.create') }}"
                class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-0">
                @svg('tabler-plus', 'w-5 h-5 mr-2')
                Thêm danh mục
            </a>
            <a href="{{ route('admin.trash.listcate') }}"
                class="flex items-center justify-center px-4 py-2 text-sm text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-0">
                @svg('tabler-trash', 'w-5 h-5 mr-2')
                Thùng rác
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                @svg('tabler-rotate-clockwise', 'w-4 h-4 mr-2')
                Làm mới
            </a>
        </div>

        <div class="overflow-x-auto">
            
        </div>
    </div>
@endsection
