<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest('id')->paginate(10);
        return view('admins.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.page.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        Page::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'status' => $request->has('status') ? 1 : 0, // Đặt trạng thái thành 1 nếu checkbox được chọn, ngược lại là 0
            'content' => $request->input('content'),
        ]);

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.pages.index')->with('success', 'Trang đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // xóa mềm
    public function destroy(Page $page)
    {
        $page->delete(); // Xóa trang

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.pages.index')->with('success', 'Trang đã được xóa thành công.');
    }
    // thùng rác
    public function trashPage(){
        $pages = Page::onlyTrashed()->latest('id')->paginate(10);
        return view('admins.page.trash',compact('pages'));
    }
    // khoi phục
    
    // xóa vĩnh viễn
    public function forceDestroy($id)
{
    $page = Page::withTrashed()->find($id);
        $page->forceDelete();
        return back()->with('success', 'Đã xóa vĩnh viễn!');
}

}
