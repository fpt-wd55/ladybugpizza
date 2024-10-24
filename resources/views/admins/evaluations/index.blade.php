@extends('layouts.admin')
@section('title', 'Đánh Giá')
@section('content')
    {{ Breadcrumbs::render('admin.evaluations.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4  space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h2 class="font-medium text-gray-700 text-base">
                    Đánh giá
                </h2>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3 p-4">       
                <a href="{{ route('admin.evaluations.export') }}"
                class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0">
                @svg('tabler-file-export', 'w-4 h-4 mr-2')
                Xuất dữ liệu
            </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left ">
                <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">STT</th>
                        <th scope="col" class="px-4 py-3">Tên Sản Phẩm</th>
                        <th scope="col" class="px-3 py-3 ">Hình Ảnh</th>
                        <th scope="col" class="px-3 py-3 ">Đánh Giá Trung Bình</th>
                        <th scope="col" class="px-3 py-3 text-center">Số lượt đánh giá</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Hành động</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- item --}}
                 
                  @forelse ($product as $key => $item)
                 
                      
                  <tr class="border-b">
                      <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                        {{ ($product->currentPage() - 1) * $product->perPage() + $key + 1 }}
                      </th>
                      <td class="px-4 py-3">{{$item->name}}</td>

                      <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                          <img loading="lazy" src="{{ asset('storage/uploads/products/' . $item->image) }}"
                              class="w-14 h-14 img-circle object-cover">
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center gap-0.3">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $item->avg_rating)
                                    @svg('tabler-star-filled', 'icon-sm text-red-500')
                                @else
                                    @svg('tabler-star', 'icon-sm text-red-500')
                                @endif
                            @endfor
                        </div>
                      </td>
                      <td class="px-3 py-3 text-center font-semibold">{{$item->total_rating}}</td>
                      <td class="px-4 py-3 flex items-center justify-end">
                          <button id="{{$item->name}}-dropdown-button"
                              data-dropdown-toggle="{{$item->name}}-dropdown"
                              class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none pt-4"
                              type="button">
                              @svg('tabler-dots', 'w-5 h-5')
                          </button>
                          <div id="{{$item->name}}-dropdown"
                              class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                              <ul class="py-1 text-sm text-gray-700"
                                  aria-labelledby="{{$item->name}}-dropdown-button">

                                  <li>
                                      <a href="{{route('admin.comment-products',$item->id)}}"
                                          class="block py-2 px-4 hover:bg-gray-100">Chi Tiết </a>
                                  </li>
                              </ul>
                          </div>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="6" class="text-center py-4 text-base">
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
                {{ $product->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
