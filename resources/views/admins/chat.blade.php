@extends('layouts.admin')
@section('title', 'Chat')
@section('content')
    {{ Breadcrumbs::render('admin.chats.index') }}
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="bg-white relative shadow sm:rounded-lg overflow-hidden">
            <div class="flex h-h-screen max-h-svh antialiased text-gray-800">
                <div class="flex flex-row w-full overflow-x-hidden h-[75vh]">
                    <div class="flex flex-col p-5 w-16 md:w-64 bg-white flex-shrink-0 h-full border-r-2">
                        <div class="flex flex-col space-y-1 -mx-3 h-screen overflow-y-auto no-scrollbar">
                            @for ($i = 0; $i < 10; $i++)
                                <button class="flex flex-row items-center hover:bg-gray-100 rounded-lg p-2">
                                    <div
                                        class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full shrink-0">
                                        H
                                    </div>
                                    <div class="ml-2 text-sm font-semibold hidden md:block">Henry Boyd</div>
                                </button>
                                <button class="flex flex-row items-center hover:bg-gray-100 rounded-lg p-2">
                                    <div class="flex items-center justify-center h-8 w-8 bg-gray-200 rounded-full shrink-0">
                                        M
                                    </div>
                                    <div class="ml-2 text-sm font-semibold hidden md:block">Marta Curtis</div>
                                    <div
                                        class="md:flex items-center justify-center ml-auto text-xs text-white bg-red-500 h-4 w-4 rounded leading-none hidden ">
                                        2
                                    </div>
                                </button>
                            @endfor
                        </div>
                    </div>
                    <div class="flex flex-col flex-auto h-full">
                        <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl h-full px-5">
                            <div class="flex flex-col h-full overflow-x-auto mb-4 overflow-y-auto">
                                <div class="flex flex-col h-full pe-4">
                                    @for ($i = 0; $i < 10; $i++)
                                        <div class="flex items-start gap-2.5 my-5">
                                            <img class="w-8 h-8 rounded-full"
                                                src="https://blade-ui-kit.com/images/icon.svg">
                                            <div class="flex flex-col gap-1 w-full">
                                                <div class="flex justify-start items-center space-x-2 rtl:space-x-reverse">
                                                    <span class="text-sm font-semibold text-gray-900">Bonnie Green</span>
                                                    <span class="text-sm font-normal text-gray-500">11:46</span>
                                                </div>
                                                <div
                                                    class="flex flex-col leading-1.5 p-3 border-gray-200 bg-gray-100 rounded-lg">
                                                    <p class="text-sm font-normal text-gray-900"> That's awesome. I think
                                                        our
                                                        users
                                                        will really appreciate the improvements.</p>
                                                </div>
                                                <div
                                                    class="flex flex-col leading-1.5 p-3 border-gray-200 bg-gray-100 rounded-lg">
                                                    <p class="text-sm font-normal text-gray-900"> That's awesome. I think
                                                        our
                                                        users
                                                        will really appreciate the improvements.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-2.5 my-5">
                                            <div class="flex flex-col gap-1 w-full">
                                                <div class="flex justify-end items-center space-x-2 rtl:space-x-reverse">
                                                    <span class="text-sm font-semibold text-gray-900">Bonnie Green</span>
                                                    <span class="text-sm font-normal text-gray-500">11:46</span>
                                                </div>
                                                <div
                                                    class="flex flex-col leading-1.5 p-3 border-gray-200 bg-gray-100 rounded-lg">
                                                    <p class="text-sm font-normal text-gray-900"> That's awesome. I think
                                                        our
                                                        users
                                                        will really appreciate the improvements.</p>
                                                </div>
                                            </div>
                                            <img class="w-8 h-8 rounded-full"
                                                src="https://blade-ui-kit.com/images/icon.svg">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="flex flex-row items-center h-16 rounded-lg bg-white w-full pe-4 mb-5">
                                <form class="flex items-center justify-center w-full space-x-2">
                                    <input
                                        class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-red-500 disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
                                        placeholder="Nhập tin nhắn" value="">
                                    <button
                                        class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-red-600 hover:bg-red-700 h-10 px-8 py-2">
                                        Gửi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
