@extends('layouts.admin')
@section('title', 'Điểm thành viên | chi tiết')
@section('content')
{{ Breadcrumbs::render('admin.memberships.edit',$membership) }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
       

        <div class="overflow-x-auto">
            
            <div>
                <div class="grid grid-cols-2 gap-6 border-b border-gray-200 py-4  lg:grid-cols-4 xl:gap-16">
                  {{-- rank --}}
                </div>
                <div class="py-4 md:py-8">
                    <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                        <div class="space-y-4">
                            <div class="flex space-x-4">
                                <img loading="lazy" class="border-2 border-[#D30A0A] img-circle w-20 h-20 ml-2 rounded" src="{{ asset('storage/uploads/avatars/'. $membership->user->avatar) }}"
                                    alt="Avatar" />
                                <div>
                                    <div class="flex ms-2">
                                        <span
                                            class="flex items-center text-green-500">@svg('tabler-circle-filled', 'w-3 h-3')</span>
                                        <span
                                            class="inline-block rounded bg-primary-100 px-1 text-xs font-medium text-primary-800 ">
                                           
                                        </span>
                                    </div>
                                    <h2
                                        class="flex items-center text-xl font-bold ms-2 mt-2 leading-none text-gray-900  sm:text-2xl">
                                        </h2>
                                </div>
                            </div>
                            <dl class="">
                                <dt class="font-semibold text-gray-900 ">Email</dt>
                                <dd class="text-gray-500 "></dd>
                            </dl>
                           
                        </div>
                        <div class="space-y-4">
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Số điện thoại</dt>
                                <dd class="text-gray-500 "></dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Ngày sinh</dt>
                                <dd class="text-gray-500 "></dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Giới tính</dt>
                                <dd class="text-gray-500 ">
                                  
                                </dd>
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Vai trò</dt>
                              
                            </dl>
                            <dl>
                                <dt class="font-semibold text-gray-900 ">Trạng thái</dt>
                               
                            </dl>
                        </div>
                    </div>
                    <a href=""
                        class="inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-0 sm:w-auto">
                        @svg('tabler-edit', 'h-5 w-5 text-white me-2')
                        Cập nhật 
                    </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection
