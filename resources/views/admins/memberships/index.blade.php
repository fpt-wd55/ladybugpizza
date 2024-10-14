@extends('layouts.admin')
@section('title', 'Điểm thành viên')
@section('content')
    {{ Breadcrumbs::render('admin.memberships.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
      
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-xs md:text-sm">Tài khoản</th>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-xs md:text-sm ">Họ và tên</th>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-center text-xs md:text-sm">Thứ hạng</th>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-xs md:text-sm">Trạng thái</th>
                        <th scope="col" class="md:px-0 md:py-0 lg:px-4 lg:py-3 text-xs md:text-sm">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
               {{-- star item --}}
               @forelse ($memberships as $membership)
                   
               {{-- @dd($membership) --}}
               <tr class="border-b hover:bg-gray-100">
                   <td class="flex items-center lg:px-4 lg:py-2 text-gray-900 whitespace-nowrap mt-3">
                       <a href="{{route('admin.memberships.edit',$membership)}}">
                           <img loading="lazy" src="{{ asset('storage/uploads/avatars/'. $membership->user->avatar) }}" alt="Avatar"
                               class="img-circle img-sm lg:w-11 lg:h-11 mr-3 rounded border-2 hover:border-[#D30A0A] " {{ Auth::user()->avatar() }}>
                       </a>
                       <a href="{{route('admin.memberships.edit',$membership)}}" class="hover:text-[#D30A0A]">
                           <div class="grid grid-flow-row">
                               <span class="md:text-xs lg:text-sm">{{$membership->user->username}}</span>
                               <span class=" text-gray-500">{{$membership->user->email}}</span>
                           </div>
                       </a>
                   </td>
                   <td class=" text-gray-900 whitespace-nowrap ">{{$membership->user->fullname}}</td>
                   <td class="lg:px-4 lg:py-2 text-gray-900 whitespace-nowrap ">  
                    <div class="flex flex-col items-center">        
                        <img loading="lazy" src="{{ asset('storage/uploads/ranks/'.$membership->rank_img) }}" alt="" class=" img-circle img-sm md:w-14 md:h-14">
                        <p class="uppercase text-xs md:text-sm md:font-medium lg:font-semibold 
                         @php
                            switch ($membership->rank_name) {
                                case 'Đồng':
                                    echo ' text-[#C67746]'; // màu chữ nâu và nền vàng nhạt
                                    break;
                                case 'Bạc':
                                    echo 'text-gray-500'; // màu chữ xám và nền xanh nhạt
                                    break;
                                case 'Vàng':
                                    echo 'text-yellow-300'; // màu chữ vàng đậm và nền vàng nhạt
                                    break;
                                case 'Kim Cương':
                                    echo 'text-blue-400'; // màu chữ xanh đậm và nền xanh nhạt
                                    break;
                                default:
                                    echo 'text-gray-100'; // mặc định
                                    break;
                                } 
                            @endphp
                        ">{{ $membership->rank_name }}</p>
                    </div>                 
                   </td>
                   <td class="md:px-0 md:py-0 lg:px-4 lg:py-2 text-gray-900 whitespace-nowrap ">
                       <div class="flex items-center">
                        <div
                        class="inline-block indicator {{ $membership->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                    </div>
                    {{ $membership->status == 1 ? 'Hoạt động' : 'Khóa'}}
                       </div>
                   </td>
                   <td class="lg:px-4 lg:py-3 items-center justify-end hidden md:block">
                       <button id="{{$membership->id}}" data-dropdown-toggle="{{$membership->id}}-dropdown"
                           class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                           type="button">
                           @svg('tabler-dots', 'w-5 h-5')
                       </button>
                       <div id="{{$membership->id}}-dropdown"
                           class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                           <ul class="py-1 text-sm text-gray-700" aria-labelledby="{{$membership->id}}">
                               <li>
                                   <a href="{{route('admin.memberships.edit',$membership)}}"
                                       class="block py-2 px-4 hover:bg-gray-100">Chi tiết</a>
                               </li>
                             
                           </ul>
                       </div>
                   </td>
               </tr>
               @empty
               <tr>
                <td colspan="5" class="text-center py-4 text-base">
                    <div class="flex flex-col items-center justify-center  p-6 rounded-lg bg-white w-full h-80">
                        @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                        <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                    </div>
                </td>
            </tr>
               @endforelse
               {{-- end item --}}

                  
                </tbody>
            </table>
            <div class="p-4">
                {{ $memberships->links() }}
            </div>
        </div>
    </div>
@endsection
