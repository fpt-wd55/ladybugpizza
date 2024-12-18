<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\Route as FacadesRoute;

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
        if (!$this->checkSlug($request->input('slug'))) {
            return redirect()->back()->with('error', 'Đường dẫn đã tồn tại trong hệ thống');
        }

        Page::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'status' => $request->has('status') ? 1 : 0,
            'content' => $request->input('content'),
        ]);
        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.pages.index')->with('success', 'Trang đã được tạo thành công.');
    }

    public function checkSlug($slug)
    {
        // Kiểm tra trong bảng `pages`
        $existsInPages = Page::where('slug', $slug)->exists();

        // Kiểm tra trong danh sách route
        $existsInRoutes = collect(FacadesRoute::getRoutes())->pluck('uri')->contains($slug);

        return !$existsInPages && !$existsInRoutes;
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
        return view('admins.page.edit', compact('page'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $data = $request->all();
        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->status = $data['status'] ?? 0; // Set mặc định là 0 nếu không có status
        $page->content = $data['content'];
        // Lưu lại thay đổi
        $page->save();
        // Chuyển hướng về trang danh sách trang với thông báo thành công
        return redirect()->route('admin.pages.index')->with('success', 'Cập nhật trang thành công!');
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
    public function trashPage()
    {
        $pages = Page::onlyTrashed()->latest('id')->paginate(10);
        return view('admins.page.trash', compact('pages'));
    }
    // khoi phục
    public function resPage($id)
    {
        $page = Page::withTrashed()->find($id);
        $page->restore();
        return back()->with('success', 'Khôi phục thành công');
    }
    // xóa vĩnh viễn
    public function forceDestroy($id)
    {
        $page = Page::withTrashed()->find($id);
        $page->forceDelete();
        return back()->with('success', 'Đã xóa vĩnh viễn!');
    }
    public function export()
    {
        $this->exportExcel(Page::all(), 'danhsachtrang');
    }
}
