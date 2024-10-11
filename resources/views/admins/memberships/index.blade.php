@extends('layouts.admin')
@section('title', 'Điểm thành viên')
@section('content')
    {{ Breadcrumbs::render('admin.memberships.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
      
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Tài khoản</th>
                        <th scope="col" class="px-4 py-3">Họ và tên</th>
                        <th scope="col" class="px-4 py-3 text-center">Thứ hạng</th>
                        <th scope="col" class="px-4 py-3">Trạng thái</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
               {{-- star item --}}
               @forelse ($memberships as $membership)
                   
               {{-- @dd($membership) --}}
               <tr class="border-b hover:bg-gray-100">
                   <td class="flex items-center px-4 py-2 text-gray-900 whitespace-nowrap mt-3">
                       <a href="">
                           <img loading="lazy" src="{{ asset('storage/uploads/avatars/'. $membership->user->avatar) }}" alt="Avatar"
                               class="img-circle w-10 h-10 mr-3 rounded">
                       </a>
                       <a href="">
                           <div class="grid grid-flow-row">
                               <span class="text-sm">{{$membership->user->username}}</span>
                               <span class="text-sm text-gray-500">{{$membership->user->email}}</span>
                           </div>
                       </a>
                   </td>
                   <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">{{$membership->user->fullname}}</td>
                   <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">  
                    <div class="flex flex-col items-center">        
                        <img loading="lazy" src="{{ asset($membership->rank_img) }}" alt="" class=" img-circle ">
                        <p class="uppercase font-semibold text-yellow-300">{{ $membership->rank }}</p>
                    </div>                 
                   </td>
                   <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                       <div class="flex items-center">
                        <div
                        class="inline-block indicator {{ $membership->status == 1 ? 'bg-green-700' : 'bg-red-700' }}">
                    </div>
                    {{ $membership->status == 1 ? 'Hoạt động' : 'Khóa' }}
                       </div>
                   </td>
                   <td class="px-4 py-3 flex items-center justify-end">
                       <button id="1" data-dropdown-toggle="1-dropdown"
                           class="inline-flex items-center p-0.5 text-sm text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                           type="button">
                           @svg('tabler-dots', 'w-5 h-5')
                       </button>
                       <div id="1-dropdown"
                           class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                           <ul class="py-1 text-sm text-gray-700" aria-labelledby="1">
                               <li>
                                   <a href=""
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
